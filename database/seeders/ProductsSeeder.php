<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Comedor',
                'image' => 'https://app-vendedor-img-step-prd.s3.amazonaws.com/7018829/691418.jpeg',
                'price' => 1459000,
            ],
            [
                'name' => 'Silla',
                'image' => 'https://www.mueblesyaccesorios.com.co/cdn/shop/products/silla-comedor-milan-bolena-plomo_3.jpg',
                'price' => 312000,
            ],
            [
                'name' => 'Escritorio',
                'image' => 'https://www.mueblesyaccesorios.com.co/cdn/shop/files/escritorio-hiver-olmo-mueblesyaccesorios-1_8c49c303-a4c2-4080-89cb-c9731169b888.jpg',
                'price' => 1071520,
            ],
            [
                'name' => 'Sofá Quito', 
                'image' => 'https://tugocolombia.vtexassets.com/arquivos/ids/275166-1200-auto',
                'price' => 1895000,
            ],
            [
                'name' => 'Nochero',
                'image' => 'https://tugocolombia.vtexassets.com/arquivos/ids/276021-1200-auto?v=638253747237330000',
                'price' => 349000,
            ],
            [
                'name' => 'Cama Queen', 
                'image' => 'https://tugocolombia.vtexassets.com/arquivos/ids/253728-1200-auto',
                'price' => 1639000,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
