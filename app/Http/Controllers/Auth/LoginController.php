<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // $request->session()->regenerate(); tạo lại id phiên làm việc
            // $request->session()->invalidate(); tạo lại id phiên và xóa tát cả dữ liệu
            return redirect()->intended('/home');
            // intended() truy cập trang hiện tại mà bạn muốn đến
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
        // onlyInput('email') dùng để hiện thì thằng old trong form
    }

    public function logout()
    {
        Auth::logout();

        // \request()->session()->invalidate();
        session()->invalidate();


        return redirect('/');
    }
}
