<?php

namespace App\Console\Commands\Products;

use App\Repositories\EloquentProductRepository;
use Illuminate\Console\Command;

class UpdateProductCommand extends Command
{
    protected $signature = 'app:update-product-command';
    protected $description = 'Comando para actualizar un producto.';

    public function handle()
    {
        $this->info("DASHBOARD - PRODUCTS - ACTUALIZAR");
        $productRepository = new EloquentProductRepository();

        $productID = intval(
            $this->ask('Ingrese ID de producto: ')
        );

        $product = $productRepository->findByID($productID);

        $this->info("Nombre: " . $product->name);
        $this->info("Imagen: " . $product->image);
        $this->info("Price: " . $product->price);


        $name = $this->ask('Nuevo nombre: ');
        $image = $this->ask('Nueva imagen: ');
        $price = floatval(
            $this->ask('Nuevo precio: ')
        );

        $product = $productRepository->update(
            $productID,
            $name,
            $image,
            $price
        );

        $this->warn('Producto actualizado exitosamente.');
    }
}
