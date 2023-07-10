<?php

namespace App\Http\Controllers\Web\Contacts;

use App\Repositories\EloquentContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class StoreController
{
    private EloquentContactRepository $contactRepository;

    public function __construct(EloquentContactRepository $contactRepositoryInject)
    {
        $this->contactRepository = $contactRepositoryInject;
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $newFullName = $request->get('full_name');
        $newPhone = $request->get('phone');
        
        $this->contactRepository->store($newFullName, $newPhone);

        return Redirect::to('contacts/create');
    }
}
