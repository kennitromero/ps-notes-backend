<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;

class AddQuantityProductsWithoutCalculateToOrders extends Seeder
{
    public function run(): void
    {
        // Poblar la base de datos... Iniciar una base, o reparar parcialmente una específica

        // Vamos a reparar la información de la tabla orders respecto a las órdenes viajes que no
        // tiene calculado la cantidad de productos comprados.

        $orders = Order::where('quantity_products', '<=', 0)->get();

        foreach ($orders as $o) {
            $orderProducts = OrderProduct::where('order_id', '=', $o->id)->get();
            
            $quantityProduct = 0;
            foreach ($orderProducts as $op) {
                $quantityProduct += $op->quantity;
            }

            $o->quantity_products = $quantityProduct;
            $o->save();
        }
    }
}
