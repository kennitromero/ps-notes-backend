<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
</head>

<body>
    <form action="{{ url('register') }}" method="POST">
        @csrf

        <h3>Crear tu cuenta</h3>

        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" placeholder="Pepito Pérez" value="{{ old('name') }}">
        <br><br>

        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" placeholder="pepito@perez.co" value="{{ old('email') }}">
        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <br><br>

        @if (session()->has('message'))
        <strong>
            {{ session()->get('message') }}
        </strong>
        <br><br>
        @endif

        <button type="submit">Crear mi cuenta</button>

        <br>

        ¿Ya tienes una cuenta?
        <a href="{{ url('login') }}">
            ven a iniciar sesión
        </a>

    </form>
</body>

</html>
