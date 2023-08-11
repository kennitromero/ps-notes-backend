@extends('layouts.main')

@section('title-page')
    Detalle de Checkout
@endsection

@section('main-page')
    <h4 style="text-align: center;">
        Resumen de transacción
    </h4>

    <div class="row justify-content-center">
        <div class="col-8">


            <!DOCTYPE html>
            <html>

            <head>
                <title></title>
                <meta charset="UTF-8">
            </head>

            <body>
                <table class="table table-bordered text-center align-middle">
                    <tr>
                        <th>Código Interno</th>
                        <th>Banco</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                        <td>{{ $data['transactionId'] }}</td>
                        <td>{{ $data['pseBank'] }}</td>
                        <td>
                            @if ($data['lapTransactionState'] === 'APPROVED')
                                <span class="badge bg-success">{{ $data['message'] }}</span>
                            @endif

                            @if ($data['lapTransactionState'] === 'PENDING')
                                <span class="badge bg-warning">{{ $data['message'] }}</span>
                            @endif

                            @if ($data['lapTransactionState'] === 'DECLINED')
                                <span class="badge bg-danger">{{ $data['message'] }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Código de Referencia</th>
                        <th>Método de Pago</th>
                        <th>Valor de la compra</th>
                    </tr>
                    <tr>
                        <td>{{ $data['referenceCode'] }}</td>
                        <td>{{ $data['lapPaymentMethod'] }}</td>
                        <td>{{ format_cop($data['TX_VALUE']) }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de Transacción</th>
                        <th>Nombre del comprador</th>
                        <th>Correo electrónico comprador</th>
                    </tr>
                    <tr>
                        <td>{{ $data['processingDate'] }}</td>
                        <td>{{ $orderPayment->payer_full_name }}</td>
                        <td>{{ $orderPayment->payer_email_address }}</td>
                    </tr>
                </table>
            </body>

            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-success">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection
