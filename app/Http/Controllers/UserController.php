<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateEmailRequest;
use App\Policies\UserPolicy;

use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use App\Traits\AddressIp;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //guarda la direccion Ip del cliente
        AddressIp::guardarIp();

        // Policies
        if($request->user()->cant('index',$request->user()))
            abort('403','No Autorizado');

        $users = User::paginate(15);
        $users->each(function($user){
            $user->privilege;
        });

        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        // Policies
        if($request->user()->cant('view',$user))
            abort('403','No Autorizado para ver este perfil');

        $userAuth = Auth::user()->privilege_id;

        if(isAdmin($userAuth)){
            $user->privilege;
            return $user;
        }

        $privilegeName= User::find($user->id)->privilege->name;

        $user->privilege= ['name'=>$privilegeName];

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        // Policies
        if($request->user()->cant('edit',$user))
            abort('403','No Autorizado para Editar este perfil');

        return view('user.form-edit')->with(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, $id)
    {
        //guarda la direccion Ip del cliente
        AddressIp::guardarIp();

        $user = User::find($id);

        if($user->email!=$request->email){
            $request->validate(
                ['email'=>'required|email|max:255|unique:users',],
                [
                    'email.unique'=>'El email ya esta registrado',
                    'email.email'=>'El email debe ser una dirección de correo electrónico válida.',
                    'email.max'=>'El email no debe superar 255 caracteres',
                ]
            );

            $user->email_verified_at = NULL;
        }

        // Policies
        if($request->user()->cant('update',$user))
            abort('403','No Autorizado para ver Actualizar este perfil');

        $userIni = $user->name;
        $cleanRequest = Purify::clean($request->post());
        $user->name = $cleanRequest['name'];
        $user->phone = $cleanRequest['phone'];
        $user->email = $cleanRequest['email'];

        if(isAdmin($request->user()->privilege_id))
            $user->privilege_id= $cleanRequest['privilege_id'];

        if(!$user->update())
            return back()->withErrors(['update'=>'No se pudo actualizar']);

        $user->privilege;

        return $user;
    }

    /**
     * Muestra el formulario para confirmar el borrado del usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        // Policies
        if($request->user()->cant('delete',$user))
            abort('403','No Autorizado para Borrar este perfil');

        return view('user.form-delete')->with(['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //guarda la direccion Ip del cliente
        AddressIp::guardarIp();

        $user = User::find($id);

        // Policies
        if($request->user()->cant('destroy',$user))
            abort('403','No Autorizado para Eliminar este perfil');

        $user->adverts()->each(function($advert){
            $images = $advert->images;
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->address);
            }
        });

        if(!$user->delete())
            return back()->withErrors(['delete'=>'No se ha podido borrar, intentelo luego']);


        return ['success'=>'Eliminado correcto'];

    }
}
