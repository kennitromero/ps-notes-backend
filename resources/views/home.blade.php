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

    <h4 style="text-align: center;">
        Llevas {{ $quantityTotal }} productos
    </h4>

    <hr>
    <!-- los productos que tiene la tienda --->
    <div style="margin-top:10px;text-align:center;">
        @forelse ($products as $product)
            <label for="product_{{ $product->id }}" 
                style="border:1px solid #333;padding:5px;display:inline-block;margin:5px 4px;border-radius:5px">
                <p style="margin: 5px 0">
                    <strong>
                        {{ $product->name }}
                    </strong>
                    <br>
                    <small>Precio: {{ format_cop($product->price) }}</small>
                </p>
                <img src="{{ $product->image }}" width="100" alt="Imagen de producto" style="border: 1px solid #ddd;border-radius:5px;">
                <br>

                <form action="{{ url('cart/add') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit">+</button>
                </form>

                <form action="{{ url('cart/remove') }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit">-</button>
                </form>
            </label>
        @empty
            <p style="text-align: center;">No hay productos en esta tienda, vuelta pronto.</p>
        @endforelse
    </div>
</body>

</html>
