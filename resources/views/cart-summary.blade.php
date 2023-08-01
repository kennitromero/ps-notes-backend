<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu carrito de compras</title>
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
        <small style="display: block">
            <a href="{{ url('/') }}" style="text-align: center;">Volver al catálogo</a>
        </small>
    </h4>

    <table border="1" style="margin:10px auto;text-align:center;">
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Sub total</th>
        </tr>

        @forelse($carts as $index => $cart)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $cart->product->name }}</td>
            <td>
                <img src="{{ $cart->product->image }}" width="50" alt="Imagen de producto"
                    style="border: 1px solid #ddd;border-radius:5px;">
            </td>
            <td>{{ $cart->quantity }}</td>
            <td>{{ format_cop($cart->product->price) }}</td>
            <td>{{ format_cop($cart->quantity * $cart->product->price) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No hay productos en el carrito</td>
        </tr>
        @endforelse

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>Cantidad Total</th>
            <th></th>
            <th>Valor total</th>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $quantityTotal }}</td>
            <td></td>
            <td>{{ format_cop($amountTotal) }}</td>
        </tr>
    </table>

    <div style="text-align: center">
        <a href="{{ url('checkout') }}">
            Ir a pagar
        </a>
    </div>
    
</body>
</html>