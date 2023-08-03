<?php

namespace App\Http\Controllers\Web\Checkout;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\EloquentCartRepository;
use App\UseCases\{
    CalculateDeliveryAmountUseCase,
    CalculateSubTotalAmountUseCase,
    CalculateTotalAmountUseCase
};
use Illuminate\Support\Facades\Auth;

class CreateOrderController
{
    public function __invoke()
    {
        $userId = Auth::id();
        $cartRepository = new EloquentCartRepository();
        $calculateSubTotalAmountUseCase = new CalculateSubTotalAmountUseCase();
        $calculateDeliveryAmountUseCase = new CalculateDeliveryAmountUseCase();

        $carts = $cartRepository->getUserCart($userId);

        $subTotal = $calculateSubTotalAmountUseCase->execute($carts);
        $deliveryAmount = $calculateDeliveryAmountUseCase->execute($subTotal);

        $calculateTotalAmountUseCase = new CalculateTotalAmountUseCase($subTotal, $deliveryAmount);
        $iva = $calculateTotalAmountUseCase->getIVA();
        $total = $calculateTotalAmountUseCase->getTotal(); 

        $order = Order::create([
            'sub_total' => $subTotal,
            'delivery_amount' => $deliveryAmount,
            'iva' => $iva,
            'total' => $total,
            'status' => 'pending',
            'user_id' => $userId,
        ]);

        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity,
                'sub_total' => $cart->product->price * $cart->quantity,
            ]);
        }

        $cartRepository->clearCart($userId);

        session()->flash(
            'message',
            'Su pedido ha sido creado correctamente, pronto nos pondremos en contacto con usted'
        );

        return redirect()->to('/');
    }
}
