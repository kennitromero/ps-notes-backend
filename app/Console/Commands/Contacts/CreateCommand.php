<?php

namespace App\Console\Commands\Contacts;

use App\Models\Contact;
use App\Repositories\EloquentContactRepository;
use Illuminate\Console\Command;

class CreateCommand extends Command
{
    protected $signature = 'app:create-contact-command';
    protected $description = 'Command description';

    private EloquentContactRepository $contactRepository;

    public function __construct(EloquentContactRepository $contactRepositoryInject)
    {
        $this->contactRepository = $contactRepositoryInject;
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Bienvenido a la creación de contactos');

        $fullName = $this->ask('Escriba el nombre completo del contacto: ');
        $phone = $this->ask('Escriba el teléfono del contacto: ');

        $this->contactRepository->store($fullName, $phone);

        $this->info('Su contacto ha sido creado exitoso.');
    }
}
