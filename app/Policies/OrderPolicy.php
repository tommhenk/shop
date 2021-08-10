<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user){
        return $user->canDo('ORDER_VIEW_ADMIN');
    }

    public function moderator(User $user){
        return $this->canDo('ORDER_MODERATOR_ADMIN');
    }
}
