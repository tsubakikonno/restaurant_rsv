<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/authentication.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="auth_body">
    
<header class="header_Rese">
        Rese
</header>
<div class="auth">


        
        @foreach ($errors as $error)
<p>{{$error}}</p>
@endforeach
<x-auth-validation-errors  :errors="$errors" />
<div class="Rese_auth">
<h1 class="auth_ttl">Registeration</h1> 
<div class="Rese_auth_contents">

<form method="POST" action="{{ route('register') }}">

            @csrf
            <ul>
            <!-- Name -->
            <li class="information_each"><input id="name"  type="text" name="name" class="input_field" value="{{ old('name') }}" placeholder="名前"  /></li>
            <!-- Email Address -->
                <li class="information_each"><input id="email" class="input_field" type="text" name="email" value="{{ old('email') }}" placeholder="メールアドレス" /></li>
            <!-- Password -->
            <li class="information_each"><input id="password" class="input_field" type="password" name="password" placeholder="パスワード" value="{{ old('passeord') }}"
                               /></li>


            <!-- Confirm Password -->



            <li class="information_each">
                <input id="password_confirmation" 
                placeholder="確認パスワード"　 class="input_field"
                                type="password"
                                name="password_confirmation" /></li>
                                <li class="information_each"><button class="login-button" >
                    {{ __('登録') }}
                </button></li>
</ul>

</div>
</div>
</div>
</body>
</html>