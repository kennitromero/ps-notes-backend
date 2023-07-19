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
        <input type="text" name="name" id="name" placeholder="Pepito Pérez" value="Pepito Perez">
        <br><br>

        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" placeholder="pepito@perez.co" value="p@pepito.co">
        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" value="loqueseapassword">
        <br><br>

        <button type="submit">Crear mi cuenta</button>

    </form>
</body>

</html>
