<?php

namespace App\Http\Controllers\Web\Auth;

class LoginController
{
    public function __invoke()
    {
        return view('auth.login');
    }
}
