<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/restau.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="auth_body">
<header class="header_Rese">
        Rese
</header>
<div class="detail">
<div class="restau_dtl">
@foreach ($genres as $genre)
                @if ($genre->id === $restaurants->genre_id) 
                <div class="btn_ttl">
                <a href="/" class="back_index"><</a>
        <p class="restau_name-indtl">{{ $restaurants->name }}</p>

@if (session('status'))
    <p>{{ session('status') }}</p>
@endif
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif


    </div>
                <div class="restau-dtl-img">
                <img src="{{ asset('storage/restau_img/' . $genre->image_name) }}" alt="{{ $genre->name }}" class="restau-dtl-img">
                </div>
                <div class="restau_about">
                    <p>#{{ $restaurants->area }}</p>
                    <p >#{{ $genre->name }}</p>
                </div>
                @endif
            @endforeach
            
<form action="{{ route('storage') }}" method="post">
        @csrf
        <input type="hidden" name="image_name" value="{{ $genre->image_name }}">
        <button type="submit" class="saveimg">画像を保存</button>
</form>
                    <p class="restau_intro">{{$restaurants->outline}}</p>
</div>
<div class="rsv">
    <h2 class="rsv_ttl">予約</h2>
<form action="{{ route('reserve') }}" method="post">
    @csrf
    <div class="input_date">
    <ul>

 @foreach ($errors->all() as $error)
  <p class="err_msg">※{{$error}}</p>
 @endforeach

    <li class="rsv_dtl"><input type="date" name="reservation_date" id="reservation_date_input" value="{{ old('reservation_date') }}" class="input_date_dtl"></li>
    <li class="rsv_dtl"><input type="time" name="reservation_time" id="reservation_time_input" value="{{ old('reservation_time') }}" class="input_date_dtl"></li>
    <li class="rsv_dtl"><input type="number" name="number" id="quantity_input" value="{{ old('number') }}" class="input_date_dtl"></li>

    @if (Auth::check())
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="restaurant_id" value="{{ $restaurants->id }}">
    @endif
</ul>
</div>
<div class="input_review">
    <ul>
    <li class="input_review_confirm">Shop: {{ $restaurants->name }}</li>
                <li class="input_review_confirm">Date :<span id="reservation_date_confirm"></span></li>
                <li class="input_review_confirm">Time : <span id="reservation_time_confirm"></span></li>
                <li class="input_review_confirm">人数　: <span id="number_confirm"></span></li>
            </ul>
    </ul>
</div>

    <button type="submit" class="rsv_btn">予約する</button></div>
</form>
</div>

</body>
<script src="/js/date.js"></script>
</html>