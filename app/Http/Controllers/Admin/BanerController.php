<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BanerController extends Controller
{
    public function index()
    {
        $baners = Baner::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.baners.index', [
            'baners' => $baners
        ]);
    }

    public function edit(Baner $baner)
    {

        return view('admin.baners.edit', [
            'baner' => $baner,
        ]);
    }

    public function update(Request $request, Baner $baner)
    {

        // dd($request->post_images);
        $baner->comment = $request->comment;
        $baner->url = $request->url;

        if ($request->status)
            $baner->status = 1;
        else
            $baner->status = 0;



        $this->validate($request,
            ['baner' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);



        if ($request->file('baner') != NULL) {

            if ($baner->baner) {
                if (file_exists(storage_path('app/public/baners/' . $baner->baner)))
                    unlink(storage_path('app/public/baners/' . $baner->baner));
            }


            $img = Image::make($request->file('baner'));


            $file = 'baner-' . $request->file('baner')->getClientOriginalName() . '-' . time()  . '.jpg';


            $baner->baner = $file;


            $img->save(storage_path('app/public/baners/' . $file));

        }


        // dd($request->file('post_images'));



        $baner->save();
        return redirect(route('AllBaners'))->with(['success' => 'Банер был успешно обновлен!']);

    }


}
