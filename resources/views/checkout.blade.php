<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
            <a href="{{ url('/cart-summary') }}" style="text-align: center;">Volver al carrito</a>
        </small>
    </h4>

    <table border="1" style="text-align: center;margin: 0 auto;">
        <tr>
            <th>
                Sub total
            </th>
            <th>
                Domicilio
            </th>
            <th>
                IVA
            </th>
        </tr>

        <tr>
            <td>{{ format_cop($subTotal) }}</td>
            <td>{{ format_cop($deliveryAmount) }}</td>
            <td>{{ format_cop($iva) }}</td>
        </tr>

        <tr>
            <th colspan="3">Total de la compra</th>
        </tr>
        <tr>
            <td colspan="3">{{ format_cop($total) }}</td>
        </tr>
    </table>

</body>

</html>
