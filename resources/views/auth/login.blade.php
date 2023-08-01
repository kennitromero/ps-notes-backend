<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<body>
    <form action="{{ url('login') }}" method="POST">
        @csrf

        <h3>Iniciar Sesión</h3>

        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" placeholder="pepito@perez.co" value=" }}">{{ old('email')
        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Contraseña">
        <br><br>

        @if (session()->has('message'))
            <strong>
                {{ session()->get('message') }}
            </strong>
            <br><br>
        @endif

        <button type="submit">Iniciar Sesión</button>

        <br>

        ¿No tienes una cuenta?
        <a href="{{ url('register') }}">
            ven a registrarte
        </a>
    </form>
</body>

</html>
