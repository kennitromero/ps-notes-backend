<?php

namespace App\Console\Commands\Orders;

use App\Repositories\EloquentOrderRepository;
use Illuminate\Console\Command;

class FindOrdersByUserEmailCommand extends Command
{
    public $signature = 'app:find-orders-by-user-email-command';
    public $description = 'Comando para buscar órdendes según el correo electrónico del usuario.';

    public function handle(): void
    {
        $orderRepository = new EloquentOrderRepository();

        $this->info('BUSQUEDA DE ÓRDENES SEGÚN CORREO DE USUARIO');

        $userEmail = $this->ask('Dame el correo del usuario: ');

        $orders = $orderRepository->getByUserEmail($userEmail, ['orders.id', 'total', 'status']);

        $this->table(['ID', 'Total', 'Estado', '# de productos'], $orders);
    }
}