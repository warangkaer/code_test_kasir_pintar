<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function crudUser(User $user): Response
    {
        return $user->degree == 'director'
                    ? Response::allow()
                    : Response::deny("Anda tidak memiliki akses ke halaman ini");
    }
}
