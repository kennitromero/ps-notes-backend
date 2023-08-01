<?php

namespace App\Http\Controllers\Web\Cart;

use App\Repositories\EloquentCartRepository;
use App\UseCases\CalculateQuantityProductsUseCase;
use App\UseCases\CalculateSubTotalAmountUseCase;
use Illuminate\Support\Facades\Auth;

class CartSummaryController
{
    public function __invoke()
    {
        $userId = Auth::id();

        $cartRepository = new EloquentCartRepository();
        $calculateQuantityProductsUseCase = new CalculateQuantityProductsUseCase();
        $calculateSubTotalAmountUseCase = new CalculateSubTotalAmountUseCase();

        $carts = $cartRepository->getUserCart($userId);
        $quantityTotal = $calculateQuantityProductsUseCase->execute($carts);
        $amountTotal = $calculateSubTotalAmountUseCase->execute($carts);

        return view('cart-summary', [
            'carts' => $carts,
            'quantityTotal' => $quantityTotal,
            'amountTotal' => $amountTotal
        ]);
    }
}
