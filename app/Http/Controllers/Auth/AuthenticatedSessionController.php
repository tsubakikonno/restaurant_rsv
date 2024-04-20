<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\User;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function loginShow()
    {
        return view('auth.login');
    }

    public function showManagerlogin()
    {
        return view('auth.managers.login');
    }

    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('/');
        } else {
            $user = User::where('email', $request->email)->first();
    
            if (!$user) {
                return redirect()->back()->withErrors(['login' => '入力されたメールアドレスが存在しません。']);
            }
    
            return redirect()->back()->withErrors(['login' => 'ログインに失敗しました。']);
        }
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('index'); // ログイン成功時のリダイレクト先を index に変更
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }


    public function Managerlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            $user = Manager::where('email', $request->email)->first();
    
            if (!$user) {
                return redirect()->back()->withErrors(['login' => '入力されたメールアドレスが存在しません。']);
            }
    
            return redirect()->back()->withErrors(['login' => 'ログインに失敗しました。']);
        }
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function SuperAdminloginShow(Request $request)
    {
        
        return view('superadmins.login');
    }

    
    public function SuperAdminlogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('superadmin')->attempt($credentials)) {
        return redirect()->route('superadmins');
    } else {
        $user = SuperAdmin::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['superadmins.login' => '入力されたメールアドレスが存在しません。']);
        }

        return redirect()->back()->withErrors(['superadmins.login' => 'ログインに失敗しました。']);
    }
}

public function superadminsdestroy(Request $request)
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('superadmins/login');
    }




    
}
