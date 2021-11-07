<?php

namespace App\Http\Controllers;

use App\models\Commentary;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use App\Http\Requests\comments\StoreCommentaryRequest;

class CommentaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Commentary::orderBy('created_at', 'DESC')->paginate(5);


        for ($i = 0; $i < count($comments); $i++) {
            $id = $comments[$i]['user_id'];
            $user = User::find($id);
            $contact = [
                'name' => $user ? $user->name : 'anonimo',
                'email' => $user ? $user->email : 'anonimo',
            ];
            $comments[$i]['contact'] = $contact;
        }


        return $comments;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentaryRequest $request)
    {
        $user = Auth::user();

        $commentary = new Commentary();
        $commentary->user_id = $user->id;
        $commentary->description = trim(Purify::clean($request->description));
        $commentary->save();

        $contact = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $commentary['contact'] = $contact;

        return $commentary;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function show(Commentary $commentary)
    {
        return $commentary;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentaryRequest  $request
     * @param  \App\models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentary $commentary)
    {
        $user = Auth::user();

        if ($commentary->user_id != $user->id && !isAdmin($user->privilege_id))
            abort('403', 'No autorizado a editar este comentario');

        $commentary->description = trim(Purify::clean($request->description));
        $commentary->update();

        return $commentary;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentary $commentary)
    {
        $user = Auth::user();

        if ($commentary->user_id != $user->id && !isAdmin($user->privilege_id))
            abort('403', 'No autorizado a editar este comentario');

        if (!$commentary->delete())
            return back()->withErrors(['delete' => 'No se ha podido borrar, intentelo luego']);

        $successfullyEntered = ['success' => 'Eliminado'];

        return $successfullyEntered;
    }
}
