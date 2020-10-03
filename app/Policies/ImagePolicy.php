<?php

namespace App\Policies;

use App\User;
use App\models\Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;    

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\models\Image  $image
     * @return mixed
     */
    public function delete(User $user, Image $image)
    {
        $userImg = Image::find($image->id)->advert->user;
        return $user->id==$userImg->id || $user->privilege_id==2;
    }    
}
