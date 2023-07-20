<?php

namespace App\Console\Commands\Products;

use App\Repositories\EloquentProductRepository;
use Illuminate\Console\Command;

class CreateProductCommand extends Command
{
    protected $signature = 'app:create-product-command';
    protected $description = 'Comando para crear un producto.';

    public function handle() {
        $this->info("DASHBOARD - PRODUCTS - CREACIÓN");

        $name = $this->ask('Nombre: ');
        $image = $this->ask('Imagen: ');
        $price = floatval(
            $this->ask('Precio: ')
        );

        $productRepository = new EloquentProductRepository();
        $productRepository->store($name, $image, $price);
        
        $this->warn('Producto creado exitosamente.');
    }
}