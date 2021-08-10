<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->canDo('PRODUCT_VIEW_ADMIN');
    }

    public function edit(User $user){
        return $user->canDo('PRODUCT_EDIT_ADMIN');
    }

    public function update(User $user){
        return $user->canDo('PRODUCT_UPDATE_ADMIN');
    }
}
