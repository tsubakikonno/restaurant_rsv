<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗社代表管理画面</title>
</head>
<body>
  <div class="manager_page">
    <div class="manager_top">
    <h1 class="mamager_ttl">店舗管理者専用画面</h1>
@if (Auth::guard('manager')->check())
  <h1 class="user_name">店舗名:{{$manager->name}}</h1>
@endif
</div>

<div class="qrcode">
<button id="startCamera" class="check_qr">QRカメラを起動する</button>
    <video id="cameraFeed" autoplay></video>
    <canvas id="qrCanvas" style="display: none;"></canvas>
    </div>

<div class="reservation_all">
<div class="reservation_current">
    <h2>現在の予約一覧</h2>
    @if($current_reservations->count() > 0)
        <p>現在の予約件数: {{ $current_reservations->count() }}</p>
        @foreach($current_reservations as $reservation)
        <div class="reservation_current2"> <!-- 各予約情報を囲む外側の要素 -->
            <p>予約番号: {{ $reservation->id }}</p>
            <p>予約日: {{ $reservation->reservation_date }}</p>
            <p>予約時間: {{ $reservation->reservation_time }}</p>
            <p>人数: {{ $reservation->number }}</p>
            <p>ユーザー名: {{ $reservation->user->name }}</p>
            <p>メールアドレス: {{ $reservation->user->email }}</p>
        </div>
        @endforeach
    @else
        <p>現在の予約はありません。</p>
    @endif
</div>
{{ $current_reservations->links() }}
@if(session('message'))
        <p>{{ session('message') }}</p>
    @endif


<div class="reservation_past">
    <h3>過去の予約一覧</h3>
    @foreach($past_reservations as $reservation)
    <div class="reservation_current2">
        <p>予約日: {{ $reservation->reservation_date }}</p>
        <p>予約時間: {{ $reservation->reservation_time }}</p>
        <p>人数: {{ $reservation->number }}</p>
        <p>メールアドレス: {{ $reservation->user->email }}</p>
</div>
    @endforeach
    {{ $past_reservations->links() }} <!-- ページネーションリンク -->
</div>
</div>
<div class="review_edit">
<div class="review">
    <h4>レビュー</h4>
 @if($reviews->count() > 0)
    @foreach($reviews as $review)    
   
        <p>コメント: {{ $review->comment }}</p>
        <p>評価: {{ $review->rating }}</p>
    @endforeach
    @else
        <p>レビューはありません</p>
    @endif
    {{ $reviews->links() }} <!-- ページネーションリンク -->
</div>

    <div class="restau_edit">
      <h3 class="restau_edit_ttl">店舗編集</h3>
    <form action="{{ route('managerupdate', ['id' => $restau_dtl->id]) }}" method="post">
    @csrf
    <input type="text" name="name" value="{{$restau_dtl->name}}" class="restau_edit_name">
    <textarea name="outline" class="restau_edit_outline">{{$restau_dtl->outline}}</textarea>
    <button type="submit" class="edit_btn">保存</button>
</form>
</div></div>
<form action="Managerlogout" method="post">
  @csrf
<button>ログアウト</button>
</form>
</div>

<form action="send" method="post">
  @csrf
<button>送信</button>


<script src="https://rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="manager.js"></script>
</body>
</html>