<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tag;
use App\Models\Inquiry;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\AuthCode;
use Carbon\Carbon;
use App\Mail\AuthCodeMail;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->take(6)->get();
        $article_reports = Article::with('image')->where('is_draft', false)->orderBy('created_at', 'desc')->take(6)->get();
        return view('top', compact('questions', 'article_reports'));
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('user.my_page');
        }
        return view('user.register');
    }

    public function register_post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'license' => 'string',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('user.register')->with('error', '既に登録されているメールアドレスです。');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->license = $request->license;
        $user->is_verified = false;
        $user->save();

        $authCode = random_int(100000, 999999);
        AuthCode::create([
            'email' => $user->email,
            'code' => $authCode,
            'expires_at' => now()->addMinutes(15), // 15分有効期限
        ]);

        // 認証コードのメール送信
        Mail::to($user->email)->send(new AuthCodeMail($authCode));

        $request->session()->put('email', $user->email);

        return view('user.verify_code')->with('email', $user->email);
    }

    public function showVerifyCodeForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('top');
        }

        if ($request->session()->has('email')) {
            return view('user.verify_code')->with('email', $request->session()->get('email'));
        }

        return redirect()->route('user.login');
    }

    public function verifyAuthCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);

        $authCode = AuthCode::where('email', $request->email)->where('code', $request->code)->first();

        if (!$authCode) {
            return redirect()->route('user.verify_code')->with('email', $request->email)->with('error', '認証コードが正しくありません。');
        }

        if ($authCode->expires_at < now()) {
            return redirect()->route('user.login');
        }

        $user = User::where('email', $request->email)->first();
        $user->is_verified = true;
        $user->save();

        Auth::login($user);

        $authCode->delete();

        $questions = Question::where('user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(5);
        $answers = Answer::where('user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(10);
        $tags =Tag::all()->pluck('name', 'id')->toArray();

        return redirect()->route('user.my_page', compact('questions', 'answers', 'tags'));
    }

    public function privacy_policy()
    {
        return view('privacy_policy');
    }

    public function terms_of_service()
    {
        return view('terms_of_service');
    }


    public function inquiry()
    {
        return view('inquiry');
    }

    public function inquiry_post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Inquiry::create($request->all());

        return redirect()->route('top')->with('success', 'お問い合わせを送信しました。');
    }

    public function showUserProfile($id)
    {
        $user = User::findOrFail($id);
        $tags =Tag::all()->pluck('name', 'id')->toArray();
        $questions = Question::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'questions_page');

        $answers = Answer::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'answers_page');

        $article_reports = Article::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'articles_page');
        return view('user.profile.profile', compact('user','questions', 'answers', 'article_reports'));
    }
}
