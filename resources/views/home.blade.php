@extends('layouts.main')

@section('title-page')
    Catálogo
@endsection

@section('cart-page')
    <form class="d-flex" role="search" method="GET" action="{{ url('cart-summary') }}">
        <button class="btn btn-outline-info" type="submit">

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M5.79166 2H1V4H4.2184L6.9872 16.6776H7V17H20V16.7519L22.1932 7.09095L22.5308 6H6.6552L6.08485 3.38852L5.79166 2ZM19.9869 8H7.092L8.62081 15H18.3978L19.9869 8Z"
                    fill="currentColor" />
                <path
                    d="M10 22C11.1046 22 12 21.1046 12 20C12 18.8954 11.1046 18 10 18C8.89543 18 8 18.8954 8 20C8 21.1046 8.89543 22 10 22Z"
                    fill="currentColor" />
                <path
                    d="M19 20C19 21.1046 18.1046 22 17 22C15.8954 22 15 21.1046 15 20C15 18.8954 15.8954 18 17 18C18.1046 18 19 18.8954 19 20Z"
                    fill="currentColor" />
            </svg>

            <span class="badge bg-secondary">{{ $quantityTotal }}</span>
        </button>
    </form>
@endsection

@section('main-page')
    @if (session()->has('message'))
        <p style="text-align: center">
            <strong>
                {{ session()->get('message') }}
            </strong>
            <br><br>
        </p>
    @endif

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
                <img src="{{ $product->image }}" width="125" alt="Imagen de producto"
                    style="border: 1px solid #ddd;border-radius:5px;">
                <br>

                <div class="mt-2">
                    <form action="{{ url('cart/add') }}" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-sm btn-outline-success" type="submit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4Z"
                                    fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7V11H7C6.44772 11 6 11.4477 6 12C6 12.5523 6.44772 13 7 13H11V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V13H17C17.5523 13 18 12.5523 18 12C18 11.4477 17.5523 11 17 11H13V7Z"
                                    fill="currentColor" />
                        </button>
                    </form>

                    <form action="{{ url('cart/remove') }}" method="POST" style="display: inline-block;" c>
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 11C7.44772 11 7 11.4477 7 12C7 12.5523 7.44772 13 8 13H16C16.5523 13 17 12.5523 17 12C17 11.4477 16.5523 11 16 11H8Z"
                                    fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                    fill="currentColor" />
                            </svg>
                        </button>
                    </form>
                </div>
            </label>
        @empty
            <p style="text-align: center;">No hay productos en esta tienda, vuelta pronto.</p>
        @endforelse
    </div>
@endsection
