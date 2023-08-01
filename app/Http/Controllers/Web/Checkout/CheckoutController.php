<?php

namespace App\Http\Controllers\Web\Checkout;

use App\Repositories\EloquentCartRepository;
use App\UseCases\{
    CalculateDeliveryAmountUseCase,
    CalculateSubTotalAmountUseCase,
    CalculateTotalAmountUseCase
};
use Illuminate\Support\Facades\Auth;

class CheckoutController
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
        $total = $calculateTotalAmountUseCase->getTotal();
        $iva = $calculateTotalAmountUseCase->getIVA();

        return view('checkout', [
            'subTotal' => $subTotal,
            'deliveryAmount' => $deliveryAmount,
            'iva' => $iva,
            'total' => $total,
        ]);
    }
}
