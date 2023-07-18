<?php

namespace App\Console\Commands\Products;

use App\Repositories\EloquentProductRepository;
use Illuminate\Console\Command;

class DeleteProductCommand extends Command
{
    protected $signature = 'app:delete-product-command';
    protected $description = 'Comando para eliminar producto.';

    public function handle()
    {
        $this->info("DASHBOARD - PRODUCTS - ELIMINAR");
        $productID = intval(
            $this->ask('Ingrese ID de producto: ')
        );

        $productRepository = new EloquentProductRepository();
        $productRepository->delete($productID);

        $this->warn("Producto eliminado.");
    }
}
