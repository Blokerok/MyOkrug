<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fotokonkurs;
use App\Models\PostImage;
use App\UserLib\CreatImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Transliterate;

class FotokonkursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Fotokonkurs::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.fotokonkurs.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.fotokonkurs.create');

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
            $post = session('old');
        else
            $post = new Fotokonkurs();

        $post->title = $request->title;
        $post->h1 = $request->title;
        $post->description = $request->title;
        $post->text = $request->text;
        if ($request->category_need)
            $post->category_need = 1;
        else
            $post->category_need = 0;

        session(['old' => $post]);


        $this->validate($request,
            ['image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'baner' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);

        if ($request->file('image') != NULL) {
            $img = Image::make($request->file('image'));
            $img_tumb = Image::make($request->file('image'));


            $height = $img->getHeight();
            $width = $img->getWidth();

            if ($width < 965) {
                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 819px, найдите изображение качественней !']);

            }
            if ($height < 422) {
                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 546px, найдите изображение качественней !']);
            }

        }

        $post->save();

        $post->alias = Transliterate::slugify($request->title . ' ' . $post->id);


        if ($request->file('image') != NULL) {
            $img = Image::make($request->file('image'));

           // $img = CreatImage::creat_img($img, 965, 422);
            $img_tumb = CreatImage::creat_img($img_tumb, 295, 197);


            $file = 'fotokonkurs-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
            $img_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));
        }

        if ($request->file('baner') != NULL) {
            $img = Image::make($request->file('baner'));

           // $img = CreatImage::creat_img($img, 994, 208);


            $file = 'fotokonkursbaner-' . $post->alias . '-' . $post->id . '.jpg';


            $post->baner = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
        }


        $post->save();


        return redirect(route('fotokonkurs.index'))->with(['success' => 'Фотоконкурс был успешно добавлена!']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Fotokonkurs $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Fotokonkurs $fotokonkur)
    {


        return view('admin.fotokonkurs.edit', [
            'post' => $fotokonkur
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Fotokonkurs $fotokonkur)
    {

        // dd($request->post_images);
        $novost = $fotokonkur;
        $novost->title = $request->title;
        $novost->text = $request->text;
        $novost->alias = $request->alias;
        $novost->description = $request->description;
        $novost->h1 = $request->h1;
        if ($request->category_need)
            $novost->category_need = 1;
        else
            $novost->category_need = 0;

        if ($request->stop)
            $novost->stop = 1;
        else
            $novost->stop = 0;

        $date_time_mass = explode(" ", $request->created_at);
        $date_mass = explode(".", $date_time_mass[0]);
        $novost->created_at = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];


        $this->validate($request,
            ['image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'baner' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if ($request->file('image') != NULL) {
            $img = Image::make($request->file('image'));
            $img_tumb = Image::make($request->file('image'));

            $height = $img->getHeight();
            $width = $img->getWidth();

            if ($width < 965) {
                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 819px, найдите изображение качественней !']);

            }
            if ($height < 422) {
                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 546px, найдите изображение качественней !']);
            }

        }


        if ($request->file('image') != NULL) {

            if ($novost->img) {
                if (file_exists(storage_path('app/public/fotokonkurs_image/' . $novost->img)))
                    unlink(storage_path('app/public/fotokonkurs_image/' . $novost->img));
            }


          //  $img = CreatImage::creat_img($img, 965, 422);
            $img_tumb = CreatImage::creat_img($img_tumb, 295, 197);


            $file = 'fotokonkurs-' . $novost->alias . '-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
            $img_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));

        }

        if ($request->file('baner') != NULL) {

            if ($novost->baner) {
                if (file_exists(storage_path('app/public/fotokonkurs_image/' . $novost->baner)))
                    unlink(storage_path('app/public/fotokonkurs_image/' . $novost->baner));
            }

            $img = Image::make($request->file('baner'));

       //     $img = CreatImage::creat_img($img, 994, 208);


            $file = 'fotokonkursbaner-' . $novost->alias . '-' .time().'-'. $novost->id . '.jpg';


            $novost->baner = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
        }


        // dd($request->file('post_images'));


        $novost->save();
        return redirect(route('fotokonkurs.index'))->with(['success' => 'Фотоконкурс был успешно обновлен!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fotokonkurs $fotokonkur)
    {
        $fotokonkur->delete();
        return redirect()->back()->withSuccess('Фотоконкурс был успешно удален!');
    }
}
