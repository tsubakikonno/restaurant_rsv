<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
<h1 class="auth_ttl">Thank you!</h1> 
<div class="Rese_auth_contents">


    <h2>ご利用ありがとうございました。<br></h2>
    <h2>またのご来店をお待ちしております。</h2>
    <li class="information_each">
    <a href="{{ route('index') }}" >
        <button class="login-button">
            {{ __('戻る') }}
        </button>
</a>
    </li>


</ul>

</div>
</div>
</div>
</body>
</html>
</body>
</html>