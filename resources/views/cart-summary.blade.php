@extends('layouts.main')

@section('title-page')
    Carrito
@endsection

@section('main-page')
    <table class="table table-hover text-center align-middle">
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
                    <img src="{{ $cart->product->image }}" width="70" alt="Imagen de producto"
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

    <div class="text-center">
        <a href="{{ url('checkout') }}" class="btn btn-primary">
            Ir a pagar
        </a>
    </div>
@endsection
