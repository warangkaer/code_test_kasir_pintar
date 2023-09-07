<?php

namespace App\Policies;

use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReimbursementPolicy
{
    /**
     * Create a new policy instance.
     */
    public function editUpdateReimbursement(User $user): Response
    {
        return ($user->degree === 'director' || $user->degree === 'finance')
                    ? Response::allow()
                    : Response::deny("Anda tidak memiliki akses ke halaman ini");
    }

    public function createReimbursement(User $user): Response
    {
        return $user->degree === 'staff'
                    ? Response::allow()
                    : Response::deny("Anda tidak memiliki akses ke halaman ini");
    }
}
