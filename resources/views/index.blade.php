<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/restau.css">
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


<nav class="nav" id="nav">
  <ul>
    <li><a href="/">Home</a></li>
    <li><form action="/logout" method="post">
    @csrf
  <button class="logout_button">Logout</button>
  </form></li>
  <li><a href="{{ route('mypage') }}">Mypage</a></li>

  </ul>
</nav>
<div class="menu" id="menu">
  <span class="menu__line--top"></span>
  <span class="menu__line--middle"></span>
  <span class="menu__line--bottom"></span>
</div>


<form action="search" method ="post">
    <input type="text" size="60px" name="name" value="{{ old('name') }}" placeholder = "Search...">
    @csrf
    <select name="genre_id">
    <option value="">All Genre</option>
    @foreach ($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
    @endforeach
    </select>

    <select name="area">
    <option value="">All area</option>
    @foreach ($areas as $area)
        <option value="{{ $area }}">{{ $area }}</option>
    @endforeach
</select>
</form>
<div class="restau_all">
    @foreach ($restaurants as $restaurant)
        <div class="restau_card">
            @foreach ($genres as $genre)
                @if ($genre->id === $restaurant->genre_id) 
                    <div class="restau-img">
                        <img src="{{ asset('storage/restau_img/' . $genre->image_name) }}" alt="{{ $genre->name }}" class="restau-img_dtl">
                    
                    <h2 class="restau_ttl">{{ $restaurant->name }}</h2>
                    <p class="restau_ttl">#{{ $restaurant->area }}</p>
                    <p class="restau_ttl">#{{ $genre->name }}</p>
</div>

<div class="button_dtl">
<a href="/detail/{{ $restaurant->id }}">

                        
                    <button class="restau_btn">詳しく見る</button>
</a>
@if ($restaurant->isFavorited())
    @foreach ($favoriteRestaurants as $favoriteRestaurant)
        @if ($favoriteRestaurant->restaurant_id === $restaurant->id)
            <form action="{{ route('destroy', ['id' => $favoriteRestaurant->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="heartfav"></button>
            </form>
        @endif
    @endforeach
@else
    <form action="{{ route('storerestau') }}" method="POST">
        @csrf
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
        <button type="submit" class="heartunfav"></button>
    </form>
@endif
                @endif
            @endforeach
        </div></div>
    @endforeach
</div>



</body>
<script src="{{ asset('js/manager.js') }}"></script>
</html>