<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {


        return view('test.file');

    }

    public function save_file (Request $request)
    {
      $this->validate($request,['file'=>'mimes:jpeg,jpg,png']);

        $image = $request->file('file');
        $img = \Image::make($image);

        $img->resize(819,NULL, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $height = $img->height();

        if ($height>546)
        {
            $img->crop(819, 546, 0, 400);
        }
        else
        {
            $img->crop(819, 546, 400, 0);
        }


        //  dd($img->width().' '.$img->height());
       $img->save(storage_path('public/avatars/test.jpg'));

       return back()->with('messege','Файл загружен.');
    }
}
