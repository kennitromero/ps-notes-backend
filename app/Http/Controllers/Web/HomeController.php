<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function __invoke()
    {
        if (Auth::guest()) {
            return redirect()->to('/login');
        }

        return view('home');
    }
}
