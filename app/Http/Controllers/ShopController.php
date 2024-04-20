<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\FavoriteRestaurant;
use App\Models\Genre;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Exception;
use Illuminate\Support\Facades\Storage;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Controllers\Controller;

class ShopController extends Controller
{

    public function index()
  {

    if (!Auth::guard('web')->check()) {
      return redirect('/login');
  }
    $user = Auth::user();
    $areas = ['東京', '大阪', '京都', '福岡'];
    $restaurants = Restaurant::all();  
    $genres = Genre::all();
    $favoriteRestaurants = Auth::user()->favoriteRestaurants()->get();
    return view('index', compact('user', 'restaurants', 'genres', 'areas','favoriteRestaurants'));
}

  

  public function search(Request $request)
  { 
    if (!Auth::guard('web')->check()) {
      return redirect('/login');
    }
    $user = Auth::user();
    $areas = ['東京', '大阪', '福岡'];
    $restaurants = Restaurant::with('genres')
        ->GenreSearch($request->genre_id)
        ->AreaSearch($request->area)
        ->where('name', 'LIKE', "%{$request->name}%")
        ->get();
    $genres = Genre::all();
    return view('index', compact('user', 'restaurants', 'genres', 'areas'));
    
  }

  public function mypage()
  {
    if (!Auth::guard('web')->check()) {
      return redirect('/login');
    }
      $user = Auth::user();
      $reservations = $user->reservations()->with('restaurant')->get();
      $favoriteRestaurants = Auth::user()->favoriteRestaurants()->with('restaurants')->get();
      $restaurants = Restaurant::all();  
      $genres = Genre::all();
      $pastReservations = Reservation::whereDate('reservation_date', '<', now())->get();
      return view('mypage', compact('user','reservations','favoriteRestaurants','genres','restaurants','pastReservations'));
  }
  public function showReviewForm(Request $request, $id)
{
  $rating = $request->input('rating');
    $comment = $request->input('comment');
    $reservation = Reservation::findOrFail($id);
    $reservation->update([
        'rating' => $rating,
        'comment' => $comment,
    ]);
    return redirect()->route('mypage')->with('success', '評価とコメントが保存されました。');
}

  
  public function detail($id)
  {
    $user = Auth::user();
    $areas = ['東京', '大阪', '福岡'];
    $restaurants = Restaurant::findOrFail($id);
    $genres = Genre::all();
    return view('detail', compact('restaurants', 'areas','genres','user'));
    
  }


  public function reserve(ReserveRequest $request)
  {
      $user = Auth::user();
      $areas = ['東京', '大阪', '福岡'];
      
      $reserveData = $request->except(['_token']);
      $reserveData['user_id'] = $user->id; // ユーザーIDを設定
      $reserve = Reservation::create($reserveData);
      
      return redirect()->route('thanksreserve');
  }
  

public function update(ReserveRequest $request)
{
  
  $reservations = $request->only(['reservation_date','reservation_time','number']);
  $reservation = Reservation::find($request->id);
  $reservation->update($reservations);

  // 予約に関連するレストランのマネージャーを取得
  $restaurantManager = $reservation->restaurant->manager;

  // マネージャーがログインしている場合のみ、メッセージをセッションに保存
  if (Auth::guard('manager')->check() && Auth::guard('manager')->user()->id == $restaurantManager->id) {
      $message = '予約が更新されました。';
      session()->flash('message', $message);
  }

  return redirect('/mypage');
  
}




public function thanksreserve()
{
    // 予約完了ページを表示
    return view('reservationthanks');
}


public function payment()
{

  if (!Auth::guard('web')->check()) {
    return redirect('/login');
}
  return view('/payment');
}

public function paymentstore(Request $request)
{

  if (!Auth::guard('web')->check()) {
    return redirect('/login');
}
    try {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create([
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken
        ]);

        $amount = $request->amount * 1; // セントに変換

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => 'jpy'
        ]);

        return view('paymentcomplete');

    } catch(\Stripe\Exception\CardException $e) {
        // カードエラーの場合
        return back()->with('error', $e->getError()->message);
    } catch(Exception $e) {
        // その他のエラーの場合
        return back()->with('error', '支払いに失敗しました');
    }
}

public function storage(Request $request)
{
    // 画像のファイル名を取得
    $image_name = $request->input('image_name');

    // 画像が存在することを確認
    if ($image_name) {
        // 画像が存在するパスを指定
        $image_path = public_path('storage/restau_img/' . $image_name);

        // 画像を保存する処理を行う（例: 別の場所にコピーするなど）
        // 保存が成功した場合の処理
        // フラッシュメッセージをセットしてリダイレクトなど適切な処理を行う
        return redirect()->back()->with('status', '画像を保存しました');
    } else {
        // 画像が存在しない場合の処理
        return redirect()->back()->with('error', '画像が見つかりませんでした');
    }
}

}



