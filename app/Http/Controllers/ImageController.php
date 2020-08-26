<?php

namespace App\Http\Controllers;

use App\models\image;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(image $image)
    {      

        $endisk = Storage::disk('public')->delete($image->address);

        $image->delete();

        return ['success'=>'Imagen Eliminada'];
    }
}
