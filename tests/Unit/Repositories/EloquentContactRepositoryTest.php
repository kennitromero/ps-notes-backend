<?php

namespace Tests\Unit\Repositories;

use App\Models\Contact;
use App\Repositories\EloquentContactRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class EloquentContactRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    // Cuando se ejecuta la prueba, se está apuntando a la base
    // de datos de transport_test
    // pero esta base de datos, no tiene ninguna tabla
    // entonces, le estamos diciendo que ejecute todas las migraciones
    // antes de ejecutar la prueba
    // se ejecuta la prueba, se revisan las aserciones
    // y luego, al finalizar la prueba, se eliminan todas las tablas.

    public function testMethodStoreContactWhenResponseSuccess(): void
    {
        // Dado: 
        $tempFullName = 'Foo Bar';
        $tempPhone = '3001239988';

        // acá ya estamos ejecutando lo que queremos probar
        // Cuando:
        $eloquentContactRepository = new EloquentContactRepository();
        $eloquentContactRepository->store($tempFullName, $tempPhone);

        // ¿Qué falta? comprobemos que realmente se está almacenando
        // Debería:
        $this->assertDatabaseHas('contacts', [
            'full_name' => $tempFullName,
            'phone'     => $tempPhone
        ]);

        // SQL para crear base de datos: CREATE DATABASE transport_test;
        // vendor/bin/phpunit --filter testMethodStoreWhenResponseSuccess
    }

    public function testMethodFindAllContactsResponseSuccess(): void
    {
        // Dado: 
        // ¿Deben existir? bueno, debería existir un número
        // determinado de contactos en tabla de la base de datos
        Contact::create([
            'full_name' => 'Kennit',
            'phone' => '3044044400'
        ]);

        Contact::create([
            'full_name' => 'Walter',
            'phone' => '3224458712'
        ]);

        Contact::create([
            'full_name' => 'Daniel',
            'phone' => '3028873644'
        ]);

        // Cuando:
        $eloquentContactRepository = new EloquentContactRepository();
        $result = $eloquentContactRepository->findAll();

        // Debería:
        $this->assertCount(3, $result);

        $this->assertSame($result[0]->full_name, 'Kennit');
        $this->assertSame($result[1]->full_name, 'Walter');
        $this->assertSame($result[2]->full_name, 'Daniel');
    }
}