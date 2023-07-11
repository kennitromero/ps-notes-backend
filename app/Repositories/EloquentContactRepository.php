<?php

namespace App\Repositories;

use App\Models\Contact;

class EloquentContactRepository
{

    // Create
    public function store(
        string $newFullName,
        string $newPhone
    ): Contact {
        return Contact::create([
            'full_name' => $newFullName,
            'phone' => $newPhone
        ]);
    }

    // READ
    public function findAll()
    {
        return Contact::orderBy('id')
            ->select(['id', 'full_name', 'phone'])
            ->get();
    }
}
