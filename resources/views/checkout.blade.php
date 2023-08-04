@extends('layouts.main')

@section('title-page')
    Carrito
@endsection

@section('main-page')
    <h4 style="text-align: center;">
        <small style="display: block">
            <a href="{{ url('/cart-summary') }}" style="text-align: center;">Volver al carrito</a>
        </small>
    </h4>

    <table class="table table-bordered text-center align-middle">
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

    <form action="{{ url('checkout') }}" method="POST" class="text-center">
        @csrf
        <button type="submit" class="btn btn-success">Realizar Compra</button>
    </form>
@endsection
