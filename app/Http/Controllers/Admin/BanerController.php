<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baner;
use App\Models\Info;
use App\UserLib\CreatImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function create()
    {
        return view('admin.baners.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $user = Auth::user();

        if (session()->has('old'))
            $baner = session('old');
        else
            $baner = new Baner();

        $baner->comment = $request->comment;
        $baner->url = $request->url;
        $baner->name = $request->name;
        $baner->date = $request->date;
        $baner->url = $request->url;


        if ($request->status)
            $baner->status = 1;
        else
            $baner->status = 0;

        if ($request->for_info)
            $baner->for_info = 1;
        else
            $baner->for_info = 0;


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

        return redirect(route('baner.index'))->with(['success' => 'Баннер был успешно добавлен!']);
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
        $baner->name = $request->name;
        $baner->date = $request->date;
        $baner->url = $request->url;


        if ($request->status)
            $baner->status = 1;
        else
            $baner->status = 0;

        if ($request->for_info)
            $baner->for_info = 1;
        else
            $baner->for_info = 0;


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
        return redirect(route('baner.index'))->with(['success' => 'Банер был успешно обновлен!']);

    }

    public function destroy(Baner $baner)
    {
        $baner->delete();
        return redirect()->back()->withSuccess('Баннер был успешно удален!');
    }

}
