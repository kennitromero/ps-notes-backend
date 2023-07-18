<?php

namespace App\Console\Commands\Products;

use App\Repositories\EloquentProductRepository;
use Illuminate\Console\Command;

class ListProductsCommand extends Command
{
    protected $signature = 'app:list-products-command';
    protected $description = 'Comando para listar todos los productos.';

    public function handle()
    {
        $this->info("DASHBOARD - PRODUCTS - LISTADO");

        $productRepository = new EloquentProductRepository();
        $products = $productRepository->getAll();

        $this->table(['ID', 'Nombre', 'Precio'], $products);
    }
}
