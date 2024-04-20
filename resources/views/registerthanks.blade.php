<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/authentication.css">
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

        <form method="POST" action="/register">
            @csrf
<h2>ご登録ありがとうございます。</h2>
                                <li class="information_each"><button class="login-button" >
                    {{ __('戻る') }}
                </button></li>
</ul>

</div>
</div>
</div>
</body>
</html>