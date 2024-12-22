<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MegaSoft Computación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    @if ($codigo)
        <div style="text-align: center;">
            <h1>MegaSoft Computación</h1>
            <h2>{{ $mensaje }}</h2>
            <h2 style="color: green;"><b>{{ $codigo }}</b></h2>
        </div>
    @endif

    @if ($token)
        <div style="width: 100%; height: 200px; text-align: center;">
            <h1>MegaSoft Computación</h1>
            <h2><b>{{ $mensaje }}</b></h2>
            <a href="http://localhost:8000/verificar/{{$token}}"
                type="submit" style="background-color: green; 
                color: white; border: none; padding: 10px 20px; 
                cursor: pointer; border-radius: 10px;">
                Verificar correo
            </a>
        </div> 
    @endif

    @if ($correoContact)
        <h3>Mensaje desde la página de contacto</h3>
        <p>Nombre del cliente: <b>{{ $nombre }}</b></p>
        <p>Correo del cliente: <b>{{ $correoContact }}</b></p>
        <div>
            <p>{{ $mensaje }}</p>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
