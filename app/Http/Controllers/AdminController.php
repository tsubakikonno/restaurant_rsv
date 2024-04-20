<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('superadmins.login');
    }

    public function SuperAdminlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('superadmin')->attempt($credentials)) {
            // 認証成功した場合の処理
            return redirect()->intended('superadmins');
        } else {
            // 認証失敗した場合の処理
            return redirect()->route('superadmins.login')->with('error', 'ログイン情報が正しくありません。');

        }
    }


    public function superadmins()
    {
        if (!Auth::guard('superadmin')->check()) {
            return redirect('/superadmins/login');
        }

        $managers = Manager::all();

        return view('superadmins.superadmin',compact('managers')); // 例として、admin.indexビューを返す
    }


    public function superadminCreate(Request $request)
    {

        $managers = $request->only('name','email','restaurant_id','password');
        Manager::create($managers);

        return redirect('superadmins');

    }

    public function superadminEdit(Request $request)
    {

        $managers = $request->all();
        unset($managers['_token']);
        Manager::where('id', $request->id)->update($managers);
  

        return back()->with(compact('managers')); // 例として、admin.indexビューを返す
    }

    public function superadminDelete(Request $request)
    {
        Manager::find($request->id)->delete();
        return redirect('superadmins'); // 例として、admin.indexビューを返す
    }
    
}
