<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email SetyGet</title>
</head>

<body>
    @if ($codigo)
        <p><strong>{{ $mensaje }}</strong></p><br>
        <p><strong>{{ $codigo }}</strong></p><br>
    @endif

    @if ($token)
        <p><strong>{{ $mensaje }}</strong></p><br>
        <button>{{ $token }}</button>
    @endif

    @if ($correoContact)
        <p><strong>{{ $nombre }}</strong></p><br>
        <p><strong>{{ $correoContact }}</strong></p><br>
        <p><strong>{{ $mensaje }}</strong></p><br>
    @endif
</body>

</html>