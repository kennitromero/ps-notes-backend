<?php

namespace App\Http\Controllers\Web\Checkout;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\EloquentCartRepository;
use App\Repositories\EloquentOrderProductRepository;
use App\Repositories\EloquentOrderRepository;
use App\UseCases\{
    CalculateDeliveryAmountUseCase,
    CalculateSubTotalAmountUseCase,
    CalculateTotalAmountUseCase,
    CalculateQuantityProductsUseCase,
    CreateOrderByUserCartUseCase
};
use Illuminate\Support\Facades\Auth;

class CreateOrderController
{
    public function __invoke()
    {
        $userId = Auth::id();


        $createOrderByUserCartUseCase = new CreateOrderByUserCartUseCase();
        $order = $createOrderByUserCartUseCase->execute($userId);        
        // AQUÍ DEBO CONSUMIR EL SERVICIO DE PayU para crear la URL de pago

        session()->flash(
            'message',
            'Su pedido ha sido creado correctamente, pronto nos pondremos en contacto con usted'
        );

        return redirect()->to('/');
    }
}
