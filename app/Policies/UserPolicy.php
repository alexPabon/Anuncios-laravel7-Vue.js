<?php

namespace App\Policies;

use App\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function index()
    {   
        $userAuth = Auth::user();
        $userAuth->privilege;

        return $userAuth->privilege->name=='administrador'&& $userAuth->privilege->label>=1000;
        
    }
   
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $userAuth, User $model)
    {          
        $name = $userAuth->privilege->name;
        $label = $userAuth->privilege->label;

        return $userAuth->id==$model->id || ($name=='administrador' && $label>=1000);
    }

    /**
     * Determine whether the user can edit models.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function edit(User $userAuth, User $model)
    {
        $name = $userAuth->privilege->name;
        $label = $userAuth->privilege->label;

        return $userAuth->id==$model->id || ($name=='administrador' && $label>=1000);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $userAuth, User $model)
    {
        $name = $userAuth->privilege->name;
        $label = $userAuth->privilege->label;

        return $userAuth->id==$model->id || ($name=='administrador' && $label>=1000);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $userAuth, User $model)
    {
        $name = $userAuth->privilege->name;
        $label = $userAuth->privilege->label;

        return $userAuth->id==$model->id || ($name=='administrador' && $label>=1000);
    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function destroy(User $userAuth, User $model)
    {
        $name = $userAuth->privilege->name;
        $label = $userAuth->privilege->label;

        return $userAuth->id==$model->id || ($name=='administrador' && $label>=1000);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $userAuth
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $userAuth, User $model)
    {
        //
    }
}
