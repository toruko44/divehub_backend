<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\LicenseType;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('user_name')) {
            $query->where('name', 'like', '%' . $request->user_name . '%');
        }

        if ($request->filled('mail')) {
            $query->where('email', 'like', '%' . $request->mail . '%');
        }

        if ($request->filled('created_at_start')) {
            $query->where('created_at', '>=', $request->created_at_start);
        }

        if ($request->filled('created_at_end')) {
            $query->where('created_at', '<=', $request->created_at_end);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.user.index', compact('items'));
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.user.show', compact('user'));
    }

    public function create()
    {
        $license_types = LicenseType::cases();
        return view('admin.user.create', compact('license_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
        $user->save();

        return redirect()->route('admin.user.show', $user->id);
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $licenseTypes = LicenseType::cases();
        return view('admin.user.edit', compact('user', 'licenseTypes'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user_id,
            'password' => 'nullable|string|min:8|confirmed',
            'license' => 'required|in:'.implode(',', LicenseType::values()),
        ]);

        $user = User::findOrFail($user_id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->license = $request->license;

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'ユーザー情報を更新しました。');

    }

    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return redirect()->route('admin.user.index');
    }

}
