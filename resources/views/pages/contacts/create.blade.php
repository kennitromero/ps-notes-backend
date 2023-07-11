<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <title>Crear Contacto</title>
</head>
<body>
    <h2>Crear contacto</h2>
    <form action="{{ url('contacts/store') }}" method="POST">
        @csrf
    
        <label for="full_name">Nombre completo</label>
        <input type="text" id="full_name" name="full_name">

        <br>

        <label for="phone">Teléfono</label>
        <input type="tel" id="phone" name="phone">

        <br>

        <button type="submit">Crear</button>
    </form>
</body>
</html>