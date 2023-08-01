<?php

namespace App\Http\Controllers\Web\Auth;

use App\Repositories\EloquentUserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Throwable;

class CreateAccountController
{
    public function __invoke(Request $request)
    {
        // ToDo, validaciones

        try {
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');

            $userRepository = new EloquentUserRepository();
            $userRepository->store($name, $email, $password);

            session()->flash('message', 'Su cuenta ha sido creada, ahora puede iniciar sesión.');

            return redirect()->to('/login');   
        } catch (QueryException $queryException) {
            session()->flash('message', 'El correo electrónico está siendo utilizado, intente iniciar sesión.');
            return redirect()->back()->withInput($request->all());
        }
    }
}
