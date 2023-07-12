<?php

namespace App\Repositories;

use App\Models\Contact;

class EloquentContactRepository
{
    // CREATE
    public function store(string $newFullName, string $newPhone): Contact
    {
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

    // UPDATE
    public function update(
        string $newFullName,
        string $newPhone,
        int $contactId
    ): void {
        Contact::where('id', '=', $contactId)
            ->update([
                'full_name' => $newFullName,
                'phone' => $newPhone
            ]);
    }

    // DELETE
    public function delete(int $contactId): void
    {
        Contact::destroy($contactId);
    }
}
