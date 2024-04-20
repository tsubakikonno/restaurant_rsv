<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/mypage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="auth_body">
<header class="header_Rese">
        Rese
</header>
    <div class="user">
@if (Auth::check())
  <h1 class="user_name">{{$user->name}}さん</h1>
@else
  <p>ログインしてください。（<a href="/login">ログイン</a>｜
  <a href="/register">登録</a>）</p>
@endif
</div>


<div class="mypage">
<nav class="nav" id="nav">
  <ul>
  <li><a href="/">Home</a></li>
    <li><form action="/logout" method="post">
    @csrf
  <button class="logout_button">Logout</button>
  </form></li>
  <li><a href="{{ route('payment') }}">payment</a></li>
  </ul>
</nav>
<div class="menu" id="menu">
  <span class="menu__line--top"></span>
  <span class="menu__line--middle"></span>
  <span class="menu__line--bottom"></span>
</div>
<div class="rsv_situation">

@php
    use Carbon\Carbon;
@endphp

@foreach($reservations as $reservation)
    @php
        $reservationDateTime = Carbon::parse($reservation->reservation_date . ' ' . $reservation->reservation_time);
        $currentDateTime = Carbon::now();
        $threeHoursAgo = $currentDateTime->subHours(3);
        $formattedReservationTime = $reservationDateTime->format('H:i');
    @endphp
    @if($reservationDateTime->gte($threeHoursAgo))
        <form class="update-form" action="{{ route('update', ['id' => $reservation->id]) }}" method="POST">
            @csrf
            <li class="mypg-rsv">Shop: {{ $reservation->restaurant->name }}</li>
            <li class="mypg-rsv">Date: <input type="text" name="reservation_date" value="{{ $reservation->reservation_date }}" class="rev_cg"></li>
            <li class="mypg-rsv">Time: <input type="text" name="reservation_time" value="{{ $formattedReservationTime }}" class="rev_cg"></li>
            <li class="mypg-rsv">Number: <input type="text" name="number" value="{{ $reservation->number }}" class="rev_cg"></li>
            @php
                $qrData = route('index', ['id' => $reservation->id]); 
            @endphp
            {!! QrCode::generate($qrData) !!}
            <button type="submit" class="cg_button">保存</button>
        </form>
    @endif
@endforeach
</div>

<div class="fav_restau">
    @foreach ($favoriteRestaurants as $favoriteRestaurant)
        <div class="restau_card">    
            @foreach ($restaurants as $restaurant)
                @if ($restaurant->id === $favoriteRestaurant->restaurant_id)
                    @foreach ($genres as $genre)
                        @if ($genre->id === $restaurant->genre_id) 
                            <img src="{{ asset('storage/restau_img/' . $genre->image_name) }}" alt="{{ $genre->name }}" class="restau-img_dtl">
                            <h2 class="restau_ttl">{{ $restaurant->name }}</h2>
                            <div class="dtl_txt"><p class="restau_ttl">#{{ $restaurant->area }}</p>
                            <p class="restau_ttl">#{{ $genre->name }}</p> </div>
                            <div class="dtl_button"><form action="/detail/{{ $restaurant->id }}" method="get">
                                @csrf
                                <button class="restau_btn">詳しく見る</button>
                            </form>
                            <form action="{{ route('destroy', ['id' => $favoriteRestaurant->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="heartfav">
                            </form></button>
                        </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    @endforeach
</div>

<div class="review">
    <h3 class="review_ttl">コメント&レビュー</h3>
    @foreach ($pastReservations as $reservation)
        @if ($pastReservations->isNotEmpty() && !$reservation->rating && !$reservation->comment)
            <form action="{{ route('reserve.review', ['id' => $reservation->id]) }}" method="POST">
                @csrf
                <div class="review2">
                    <p class="review_txt">店名: {{ $reservation->restaurant->name }}</p>
                    <p class="review_txt">日付: {{ $reservation->reservation_date }}</p>
                    <label for="rating" class="review_txt">評価:</label>
                    <select name="rating" id="rating" class="review_rate">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select><br>
                    <textarea name="comment" id="comment" class="review_comment" placeholder="コメントする"></textarea>
                    <button type="submit" class="rvw_btn">送信</button>
                </div>
            </form>
        @endif
    @endforeach
</div>
</body>
<script src="{{ asset('js/manager.js') }}"></script>
</html>