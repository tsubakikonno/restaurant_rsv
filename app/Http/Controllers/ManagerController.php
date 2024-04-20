<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;
use App\Models\Restaurant;
use App\Http\Requests\ManagerRequest;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe; 
use Stripe\Charge; 


class ManagerController extends Controller
{


    public function showLoginForm()
    {
        return view('auth.managers.login'); // ログインフォームを表示するビューのパスを返します
    }

    public function login(Request $request)
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





public function dashboard()
{
    if (!Auth::guard('manager')->check()) {
        return redirect('/managers/login');
    }
    $manager = Auth::guard('manager')->user();
    $restaurantId = $manager->restaurant_id;
    $restau_dtl = Restaurant::where('id', $restaurantId)->first();
    $current_reservations = Reservation::where('restaurant_id', $restaurantId)
    ->where('reservation_date', '>=', now()->toDateString())
    ->orderBy('reservation_date', 'asc')
    ->orderBy('reservation_time', 'asc')
    ->paginate(10);

// 過去の予約一覧（現在よりも前の予約）
$past_reservations = Reservation::where('restaurant_id', $restaurantId)
    ->where('reservation_date', '<', now()->toDateString())
    ->orderBy('reservation_date', 'asc')
    ->orderBy('reservation_time', 'asc')
    ->paginate(10);

// レビュー一覧（注文されたレビュー）
$reviews = Reservation::where('restaurant_id', $restaurantId)

    ->paginate(10);
    $message = session('message');

    return view('managers.dashboard', compact('manager', 'restau_dtl', 'current_reservations', 'past_reservations','reviews','message' ));
}



public function checkQR(Request $request)
{
    $qrCode = $request->input('qr_code');
    $reservation = Reservation::with('restaurant', 'user')->where('qr_code', $qrCode)->first();
    
    if ($reservation) {
        return view('qrshow', ['reservation' => $reservation]);
    } else {
        return view('qrshow', ['message' => '指定されたQRコードに対応する予約が見つかりませんでした。']);
    }
}



public function Managerlogout(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('managers/login');
    }

    public function managerupdate(ManagerRequest $request, $id)
{
    $restau_dtl = $request->only(['outline','area','name']);
    Restaurant::find($id)->update($restau_dtl);
    
    return redirect('/managers/dashboard');
}

public function send(ManagerRequest $request)
{
    Mail::send(new WelcomeMail());
    
    return redirect('/managers/dashboard');
}

public function receivePayment(Request $request)
{
    // Stripe APIや他の決済システムからの支払い情報を受け取り、処理する

    // 受け取った支払いをデータベースに記録したり、注文のステータスを更新したりする
}

    
}
