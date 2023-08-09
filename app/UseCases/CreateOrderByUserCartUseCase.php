<?php

namespace App\UseCases;

use App\Models\Order;
use App\Repositories\EloquentCartRepository;
use App\Repositories\EloquentOrderProductRepository;
use App\Repositories\EloquentOrderRepository;

class CreateOrderByUserCartUseCase
{
    public function execute(int $userId): Order
    {
        $cartRepository = new EloquentCartRepository();
        $orderRepository = new EloquentOrderRepository();
        $orderProductRepository = new EloquentOrderProductRepository();

        $calculateSubTotalAmountUseCase = new CalculateSubTotalAmountUseCase();
        $calculateDeliveryAmountUseCase = new CalculateDeliveryAmountUseCase();
        $calculateQuantityProductsUseCase = new CalculateQuantityProductsUseCase();

        $carts = $cartRepository->getUserCart($userId);

        $subTotal = $calculateSubTotalAmountUseCase->execute($carts);
        $deliveryAmount = $calculateDeliveryAmountUseCase->execute($subTotal);

        $calculateTotalAmountUseCase = new CalculateTotalAmountUseCase($subTotal, $deliveryAmount);
        $iva = $calculateTotalAmountUseCase->getIVA();
        $total = $calculateTotalAmountUseCase->getTotal();
        $quantityTotal = $calculateQuantityProductsUseCase->execute($carts);

        $order = $orderRepository->createOrder(
            $subTotal,
            $deliveryAmount,
            $iva,
            $total,
            $quantityTotal,
            $userId
        );

        foreach ($carts as $cart) {
            $orderProductRepository->create(
                $order->id,
                $cart->product_id,
                $cart->product->price,
                $cart->quantity
            );
        }

        $cartRepository->clearCart($userId);

        return $order;
    }
}