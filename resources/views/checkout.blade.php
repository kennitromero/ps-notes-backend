@extends('layouts.main')

@section('title-page')
    Checkout
@endsection

@section('main-page')
    <h4 style="text-align: center;">
        <small style="display: block">
            <a href="{{ url('/cart-summary') }}" style="text-align: center;">Volver al carrito</a>
        </small>
    </h4>

    <div class="row justify-content-center">
        <div class="col-4">
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
        </div>
    </div>

    <form action="{{ url('checkout') }}" method="POST">

        <h3 class="text-center">Información del pagador</h3>

        <div class="row justify-content-center">
            <div class="col-7">

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="fw-bold mb-2" for="contact_phone">Número de contacto</label>
                            <input class="form-control" type="text" name="contact_phone" id="contact_phone"
                                placeholder="+573045652958" value="+57 304 565 2958">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label class="fw-bold mb-2" for="dni_number">Documento de identificación</label>
                            <input class="form-control" type="text" name="dni_number" id="dni_number"
                                placeholder="1.074.456.987" value="1.073.432.456">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label class="fw-bold mb-2" for="address">Dirección completa</label>
                            <input class="form-control" type="text" name="address" id="address"
                                placeholder="Calle 32 # 36B - 29" value="Calle 32 # 36B - 29">
                        </div>
                    </div>
                </div>

                <div class="row mt-4 mb-4 justify-content-center">
                    <div class="col-4">
                        <div class="form-group">
                            <label class="fw-bold mb-2" for="state">Departamento</label>
                            <input class="form-control" type="text" name="state" id="state" placeholder="Sucre"
                                value="Sucre">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label class="fw-bold mb-2" for="city">Ciudad</label>
                            <input class="form-control" type="text" name="city" id="city" placeholder="Sincelejo"
                                value="Sincelejo">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label class="fw-bold mb-2" for="financial_institution_code">
                                Seleccione el banco a pagar
                            </label>
                            <select class="form-control" name="financial_institution_code" id="financial_institution_code">
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank['pseCode'] }}"
                                        @if ($bank['pseCode'] == 1022) selected @endif>
                                        {{ $bank['description'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @csrf
        <div class="text-center">
            <button type="submit" class="btn btn-success">Realizar Compra</button>
        </div>
    </form>
@endsection
