@extends('layouts.main')

@section('title-page')
    Mis órdenes
@endsection

@section('main-page')
    <h4 class="my-3">
        Mis Órdenes
    </h4>

    <table class="table table-hover text-center align-middle">
        <tr>
            <th>#</th>
            <th>Total</th>
            <th># de productos</th>
            <th>Estado</th>
            <th>Creada el</th>
        </tr>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ format_cop($order->total) }}</td>
                <td>{{ $order->quantity_products }}</td>
                <td>
                    @if ($order->status === 'pending')
                        <span class="badge bg-warning">Pendiente</span>
                    @endif

                    @if ($order->status === 'complete')
                        <span class="badge bg-success">Completado</span>
                    @endif

                    @if ($order->status === 'cancel')
                        <span class="badge bg-danger">Cancelado</span>
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
@endsection
