<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Potwierdzenie rezerwacji miejsc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<h1>Twoja rezerwacja została pomyślnie utworzona!</h1>
<h4>Szczegóły:</h4>
    <ul>
        <li>Film: {{$movie}}</li>
        <li>Data: {{$showingDate}}</li>
        <li>Miejsca:
            <ol>
            @foreach ($seats as $seat)
                <li>Rząd:{{$seat['row']}} -- Miejsce: {{$seat['seat']}}</li>
            @endforeach
            </ol>
        </li>
    </ul>

<h3>Możesz anulować swoją rezerwacje klikając w link:</h3>
<a href="{{$deleteURL}}">ANULUJ REZERWACJE</a>
    
</body>
</html>