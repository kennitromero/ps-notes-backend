<?php

namespace App\Http\Controllers\Web\Contacts;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;

class CreateUIController 
{
    public function __invoke(): View
    {
        return ViewFactory::make('pages.contacts.create');
    }
}