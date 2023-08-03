<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis órdenes</title>
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
        Estas son las órdenes que tienes.
    </h4>

    <p style="text-align: center;">
        <a href="{{ url('/') }}" style="text-align: center;">Regresar al catálogo</a>
    </p>

    <table border="1" style="margin: 0 auto;">
        <tr>
            <th style="padding:5px;">#</th>
            <th style="padding:5px;">Total</th>
            <th style="padding:5px;"># de productos</th>
            <th style="padding:5px;">Estado</th>
            <th style="padding:5px;">Creada el</th>
        </tr>
        @forelse($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ format_cop($order->total) }}</td>
            <td style="text-align: center;">{{ $order->order_products_count }}</td>
            <td style="padding: 10px;">
                @if ($order->status === 'pending')
                    <span style="padding:5px;border-radius:10px;background-color:yellow;">Pendiente</span>
                @endif

                @if ($order->status === 'complete')
                    <span style="padding:5px;border-radius:10px;background-color:green;">Completado</span>
                @endif

                @if ($order->status === 'cancel')
                    <span style="padding:5px;border-radius:10px;background-color:red;">Cancelado</span>
                @endif
            </td>
            <td style="text-align: center">
                {{ $order->created_at->diffForHumans() }}
                <br>
                <small>
                    {{ $order->created_at->toDayDateTimeString() }}
                </small>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No has realizado ninguna orden.</td>
        </tr>
        @endforelse
    </table>
</body>

</html>
