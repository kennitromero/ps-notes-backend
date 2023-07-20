<?php

namespace App\Http\Controllers\Web\Auth;

class RegisterController {

    public function __invoke()
    {
        return view('auth.register');
    }
}