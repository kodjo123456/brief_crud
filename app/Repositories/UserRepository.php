<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
    public function login(array $data)
    {
        return Auth::attempt($data);
    }
}

