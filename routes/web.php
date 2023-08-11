<?php

use App\Http\Controllers\Web\Auth\{
    AuthenticationController,
    RegisterController,
    CreateAccountController,
    LoginController,
    LogoutController,
};
use App\Http\Controllers\Web\Cart\{
    AddProductController,
    RemoveProductController,
    CartSummaryController
};
use App\Http\Controllers\Web\Checkout\{
    CheckoutController,
    CreateOrderController,
    CheckoutSummaryController
};
use App\Http\Controllers\Web\Contacts\{
    CreateUIController,
    StoreController,
};
use App\Http\Controllers\Web\Orders\HistoryOrderController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('contacts/create', CreateUIController::class);
Route::post('contacts/store', StoreController::class);

Route::get('register', RegisterController::class);
Route::post('register', CreateAccountController::class);

Route::get('login', LoginController::class);
Route::post('login', AuthenticationController::class);

Route::post('logout', LogoutController::class);

Route::get('/', HomeController::class);

Route::post('cart/add', AddProductController::class);
Route::delete('cart/remove', RemoveProductController::class);

Route::get('cart-summary', CartSummaryController::class);
Route::get('checkout', CheckoutController::class);
Route::post('checkout', CreateOrderController::class);
Route::get('checkout-summary', CheckoutSummaryController::class);

Route::get('orders', HistoryOrderController::class);
Route::post('payu-notify-url', function () {
    
});