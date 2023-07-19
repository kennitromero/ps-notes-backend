<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke()
    {
        Auth::logout();

        return redirect()
            ->to('/login')
            ->with('message', 'Has cerrado sesión correctamente.');
    }
}
