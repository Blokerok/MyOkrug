<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DvorImage;
use App\Models\Fotokonkurs;
use App\Models\FotoKonkursImage;
use App\Models\FotoKonkursMaterial;
use App\Models\MoyDvor;
use App\UserLib\CreatImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Transliterate;

class DvorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = MoyDvor::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.moy_dvor.index', [
            'records' => $records
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        return view('admin.moy_dvor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (session()->has('old'))
            $post = session('old');
        else
            $post = new MoyDvor();

        $post->title = $request->title;
        $post->h1 = $request->title;
        $post->description = $request->title;
        $post->text = $request->text;
        $post->shot_text = $request->shot_text;
        $post->coord = $request->coord;

        session(['old' => $post]);


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        $post->save();

        $post->alias = Transliterate::slugify($request->title . ' ' . $post->id);


        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));
            $img_tumb = Image::make($request->file('post_image'));
            $img = $img->fit( 819, 546);
            $img_tumb = $img_tumb->fit(295, 197);


            $file = 'moy-dvor-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/moy_dvor/' . $file));
            $img_tumb->save(storage_path('app/public/moy_dvor/tumb/' . 'tumb-' . $file));
        }


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if (isset($request->post_images) && count($request->file('post_images'))) {

            if (count($post->images)) {
                foreach ($post->images as $image) {
                    if(file_exists(storage_path('app/public/moy_dvor/'.$image->img)))
                        unlink(storage_path('app/public/moy_dvor/' . $image->img));
                    if(file_exists(storage_path('app/public/moy_dvor/tumb/tumb-' . $image->img)))
                        unlink(storage_path('app/public/moy_dvor/tumb/tumb-' . $image->img));
                }

                DvorImage::where('dvor_id', '=', $post->id)->delete();

            }


            foreach ($request->file('post_images') as $image) {

                $img_dop = Image::make($image);
                $img_dop_tumb = Image::make($image);
                $name_original = $image->getClientOriginalName();



                $img_dop = $img_dop->fit( 819, 546);
                $img_dop_tumb = $img_dop_tumb->fit(295, 197);


                $file = 'moy-dvor-' . Transliterate::slugify($name_original) . '-'.time().'-' . $post->id . '.jpg';


                $img_dop->save(storage_path('app/public/moy_dvor/' . $file));
                $img_dop_tumb->save(storage_path('app/public/moy_dvor/tumb/' . 'tumb-' . $file));

                $dop_image = new DvorImage();
                $dop_image->img = $file;
                $dop_image->dvor_id = $post->id;

                $dop_image->save();
            }


        }


        $post->save();


        return redirect(route('moy-dvor.index'))->with(['success' => 'Двор успешно добавлен!']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Novost $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(MoyDvor $moy_dvor)
    {


        return view('admin.moy_dvor.edit', [
            'post' => $moy_dvor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, MoyDvor $moy_dvor)
    {

        // dd($request->post_images);
        $novost = $moy_dvor;
        $novost->title = $request->title;
        $novost->text = $request->text;
        $novost->shot_text = $request->shot_text;
        $novost->alias = $request->alias;
        $novost->description = $request->description;
        $novost->h1 = $request->h1;
        $novost->coord = $request->coord;
        $date_time_mass = explode(" ", $request->created_at);
        $date_mass = explode(".", $date_time_mass[0]);
        $novost->created_at = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);




        if ($request->file('post_image') != NULL) {

            if ($novost->img) {
                if (file_exists(storage_path('app/public/moy_dvor/' . $novost->img)))
                    unlink(storage_path('app/public/moy_dvor/' . $novost->img));
            }

            $img = Image::make($request->file('post_image'));
            $img_tumb = Image::make($request->file('post_image'));

            $img = $img->fit( 819, 546);
            $img_tumb = $img_tumb->fit(295, 197);


            $file = 'moy-dvor-' . $novost->alias . '-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/moy_dvor/' . $file));
            $img_tumb->save(storage_path('app/public/moy_dvor/tumb/' . 'tumb-' . $file));

        }


        // dd($request->file('post_images'));


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);

        if (isset($request->post_images) && count($request->file('post_images'))) {

            if (count($novost->images)) {
                foreach ($novost->images as $image) {
                    if (file_exists(storage_path('app/public/moy_dvor/' . $image->img)))
                        unlink(storage_path('app/public/moy_dvor/' . $image->img));
                    if (file_exists(storage_path('app/public/moy_dvor/tumb/tumb-' . $image->img)))
                        unlink(storage_path('app/public/moy_dvor/tumb/tumb-' . $image->img));

                }
                DvorImage::where('dvor_id', '=', $novost->id)->delete();
            }



            foreach ($request->file('post_images') as $image) {

                $img_dop = Image::make($image);
                $img_dop_tumb = Image::make($image);
                $name_original = $image->getClientOriginalName();



                $img_dop = $img_dop->fit( 819, 546);
                $img_dop_tumb = $img_dop_tumb->fit(295, 197);

                $file = 'fotokonkurs-' . Transliterate::slugify($name_original) . '-'.time().'-' . $novost->id . '.jpg';

                $img_dop->save(storage_path('app/public/moy_dvor/' . $file));
                $img_dop_tumb->save(storage_path('app/public/moy_dvor/tumb/' . 'tumb-' . $file));

                $dop_image = new DvorImage();
                $dop_image->img = $file;
                $dop_image->dvor_id = $novost->id;
                $dop_image->save();
            }

        }


        $novost->save();
        return redirect(route('moy-dvor.index'))->with(['success' => 'Двор был успешно обновлен!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoyDvor $moy_dvor)
    {
        $moy_dvor->delete();
        return redirect()->back()->withSuccess('Двор был успешно удален!');
    }
}
