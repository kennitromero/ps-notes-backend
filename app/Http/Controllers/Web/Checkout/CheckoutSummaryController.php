<?php

namespace App\Http\Controllers\Web\Checkout;

use App\Repositories\EloquentOrderPaymentRepository;
use Illuminate\Http\Request;

class CheckoutSummaryController
{
    public function __invoke(Request $request)
    {
        $referenceCode = $request->get('referenceCode');

        $orderPaymentRepository = new EloquentOrderPaymentRepository();
        $orderPayment = $orderPaymentRepository->getOrderPaymentByReferenceCode($referenceCode);

        return view('checkout-summary', [
            'data' => $request->all(),
            'orderPayment' => $orderPayment
        ]);
    }
}
