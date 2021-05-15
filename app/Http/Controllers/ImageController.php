<?php

namespace App\Http\Controllers;

use App\models\Image;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, image $image)
    {
        // Policies
        if($request->user()->cant('delete',$image))
            abort('403','No Autorizado para ver eliminar esta imagen');      

        $endisk = Storage::disk('public')->delete($image->address);

        $image->delete();

        return ['success'=>'Imagen Eliminada'];
    }
}
