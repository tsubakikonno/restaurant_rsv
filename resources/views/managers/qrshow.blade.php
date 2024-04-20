<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>予約のお客様</h1>
    @if($reservation)
        <div class="reservation_current2"> <!-- 各予約情報を囲む外側の要素 -->
            <p>予約番号: {{ $reservation->id }}</p>
            <p>予約日: {{ $reservation->reservation_date }}</p>
            <p>予約時間: {{ $reservation->reservation_time }}</p>
            <p>人数: {{ $reservation->number }}</p>
            <p>ユーザー名: {{ $reservation->user->name }}</p>
            <p>メールアドレス: {{ $reservation->user->email }}</p>
        </div>
    @elseif($message)
        <p>{{ $message }}</p>
    @endif
</body>
</html>
