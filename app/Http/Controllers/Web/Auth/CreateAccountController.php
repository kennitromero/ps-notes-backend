<?php

namespace App\Http\Controllers\Web\Auth;

use App\Repositories\EloquentUserRepository;
use Illuminate\Http\Request;

class CreateAccountController
{
    public function __invoke(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');

        $userRepository = new EloquentUserRepository();
        $userRepository->store($name, $email, $password);

        return redirect()->to('/login');
    }
}
