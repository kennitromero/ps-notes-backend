<?php

namespace App\Console\Commands\Contacts;

use App\Models\Contact;
use Illuminate\Console\Command;

class CreateCommand extends Command
{    
    protected $signature = 'app:create-contact-command';

    protected $description = 'Command description';

    public function handle()
    {
        $this->info('Bienvenido a la creación de contactos');

        $fullName = $this->ask('Escriba el nombre completo del contacto: ');
        $phone = $this->ask('Escriba el teléfono del contacto: ');

        Contact::create([
            'full_name' => $fullName,
            'phone' => $phone
        ]);

        $this->info('Su contacto ha sido creado exitoso.');
    }
}
