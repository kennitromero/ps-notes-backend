<?php

namespace App\Repositories;

use App\Models\Contact;

class EloquentContactRepository
{
    public function store(string $newFullName, string $newPhone): Contact
    {
        return Contact::create([
            'full_name' => $newFullName,
            'phone' => $newPhone
        ]);
    }
}