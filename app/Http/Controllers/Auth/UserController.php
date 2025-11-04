<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\AuthCode;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tag;
use App\Models\Article;
use Carbon\Carbon;
use App\Mail\AuthCodeMail;

class UserController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->guard('user')->check()) {
            return redirect()->route('user.my_page');
        }
        return view('auth.user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $redirectTo = $request->input('redirect_to', route('user.my_page'));

        if (str_contains($redirectTo, route('password.reset', '', false))) {
            $redirectTo = route('top');
        }

        if (auth()->guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->guard('user')->user();
            if (!$user->is_verified) {
                // 認証コードを生成して再送信
                $authCode = random_int(100000, 999999);
                AuthCode::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'code' => $authCode,
                        'expires_at' => now()->addMinutes(15),
                    ]
                );

                // 認証コードを含むメールを再送信
                Mail::to($user->email)->send(new AuthCodeMail($authCode));

                auth()->guard('user')->logout();
                return redirect()->route('user.verify_code')->with('email', $user->email);
            }
            return redirect()->intended($redirectTo);
        }

        return back()->withInput($request->only('email', 'redirect_to'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgetPasswordForm()
    {
        return view('auth.user.forget-password');
    }

    public function forgetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', __($status));
        } else {
            session()->flash('error', __($status));
        }

        return redirect('/');

    }

    public function showResetPasswordForm(string $token)
    {
        return view('auth.user.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return
            $status === Password::PASSWORD_RESET
                ? redirect()->route('top')->with('success', __($status))
                : back()->with('error', __($status));

    }

    public function retire()
    {
        return view('auth.user.retire');
    }

    public function retire_post(Request $request)
    {
        $user = Auth::user();

        $user->delete();

        return redirect('/')->with('success', 'アカウントが削除されました。ご利用ありがとうございました。');

    }

    public function register_edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.register_edit', compact('user'));
    }

    public function register_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'license' => 'nullable|string',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->license = $validated['license'] ?? $user->license;
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return redirect()->route('user.my_page')->with('success', 'プロフィール情報を更新しました。');
    }
}
