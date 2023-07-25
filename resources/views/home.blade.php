<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <h1 style="text-align: center;">Esta es una tienda</h1>

    <p style="text-align: center;">
        Hola {{ auth()->user()->name }}
    </p>

    <form action="{{ url('logout') }}" method="POST" style="text-align:center;">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>

    <hr>
    <!-- los productos que tiene la tienda --->
    <div style="margin-top:10px;text-align:center;">
        @forelse ($products as $product)
            <label for="product_{{ $product->id }}" style="border:1px solid #333;padding:5px;display:inline-block">
                <p style="margin: 5px 0">
                    <strong>
                        {{ $product->name }}
                    </strong>
                    <br>
                    <small>Precio: {{ $product->price }}</small>
                </p>
                <img src="{{ $product->image }}" width="100" alt="Imagen de producto">
                <br>

                Seleccionar
                <input type="checkbox" id="product_{{ $product->id }}" name="product[]">
            </label>
        @empty
            <p style="text-align: center;">No hay productos en esta tienda, vuelta pronto.</p>
        @endforelse
    </div>
</body>

</html>
