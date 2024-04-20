<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">

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
<h1 class="auth_ttl">loginページ</h1> 
<div class="Rese_auth_contents">

        <form method="POST" action="{{ route('login') }}">
            @csrf
           
            
            <ul>
            <li class="information_each"><input id="email"  class="input_field" type="text" name="email" value="{{ old('email') }}" placeholder="Email" /></li>



            <li class="information_each"><input type ="password" id="password"　 class="input_field"
                placeholder="Password"　value="{{ old('password') }}"
                                name="password" 　
                                /></li>



                                <li class="information_each">
                                    <button class="login-button">{{ __('ログイン') }}</button>
                                </form></li>
        </ul>        

</div>
</div>
</div>
</body>
</html>