<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>予約</h1>
    <p>{{ $reservation->user->name }}様</p>
    <p>Restaurant: {{ $reservation->restaurant->name }}</p>
    <p>Date: {{ $reservation->date }}</p>
    <p>Time: {{ $reservation->time }}</p>
    <p>Number: {{ $reservation->number }}</p>
</body>
</html>