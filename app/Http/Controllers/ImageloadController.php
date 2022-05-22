<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserLib\CreatImage;
use Intervention\Image\Facades\Image;
use Transliterate;

class ImageloadController extends Controller
{
    public function upload(Request $request)
    {
        $path =  storage_path('app/public/images_material/');
        $file = $request->file('file');
        $filename = time() .'-'.Transliterate::slugify($file->getClientOriginalName()).'.jpg';
        $img = Image::make($file);
        $img = CreatImage::creat_img($img, 819, 546);
        $img->save($path . $filename,100,'jpg');
        echo '/public/storage/images_material/'.$filename;
    }

}
