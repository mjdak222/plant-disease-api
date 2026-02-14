<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminLoginController extends Controller
{
    // عرض فورم تسجيل الدخول
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->id === 5 && Auth::attempt($request->only('email', 'password'))) {
            // دخول ناجح
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'الإيميل أو كلمة المرور خاطئة أو ليس أدمن']);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
