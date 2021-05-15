<?php

namespace App\Policies;

use App\User;
use App\models\Advert;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertPolicy
{
    use HandlesAuthorization;    

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\models\Advert  $advert
     * @return mixed
     */
    public function update(User $user, Advert $advert)
    {
        return $user->id==$advert->user_id || $user->privilege_id==2;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\models\Advert  $advert
     * @return mixed
     */
    public function delete(User $user, Advert $advert)
    {
        return $user->id==$advert->user_id || $user->privilege_id==2;
    }    
}
