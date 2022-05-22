<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fotokonkurs;
use App\Models\FotoKonkursImage;
use App\Models\FotoKonkursMaterial;
use App\Models\Rubric;
use App\UserLib\CreatImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Transliterate;

class FotoKonkursMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uchastniki = FotoKonkursMaterial::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.fotokonkurs_materials.index', [
            'uchastniki' => $uchastniki
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $konkurses = Fotokonkurs::orderBy('created_at', 'DESC')->get();


        return view('admin.fotokonkurs_materials.create', [
            'konkurses' => $konkurses, 'categories'=>FotoKonkursMaterial::getCategories()
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


        if (session()->has('old'))
            $post = session('old');
        else
            $post = new FotoKonkursMaterial();

        $post->title = $request->title;
        $post->h1 = $request->title;
        $post->description = $request->title;
        $post->category_name = $request->category_name;
        $post->text = $request->text;
        $post->konkurs_id = $request->konkurs_id;
        $post->fio = $request->fio;
        $post->email = $request->email;
        $post->phone = $request->phone;
        $post->moder = 1;

        session(['old' => $post]);


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);

        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));
            $img_tumb = Image::make($request->file('post_image'));


            $height = $img->getHeight();
            $width = $img->getWidth();

            if ($width < 819) {
                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 819px, найдите изображение качественней !']);

            }
            if ($height < 546) {
                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 546px, найдите изображение качественней !']);
            }

        }

        $post->save();

        $post->alias = Transliterate::slugify($request->title . ' ' . $post->id);


        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));

            $img = CreatImage::creat_img($img, 819, 546);
            $img_tumb = CreatImage::creat_img($img_tumb, 300, 300);


            $file = 'fotokonkurs-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
            $img_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));
        }


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if (isset($request->post_images) && count($request->file('post_images'))) {

            if (count($post->images)) {
                foreach ($post->images as $image) {
                    if(file_exists(storage_path('app/public/fotokonkurs_image/'.$image->img)))
                        unlink(storage_path('app/public/fotokonkurs_image/' . $image->img));
                    if(file_exists(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $image->img)))
                        unlink(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $image->img));
                }

            FotoKonkursImage::where('uchastnik_id', '=', $post->id)->delete();

            }

            if (count($request->file('post_images'))>10)
            {
                return redirect()->back()->with(['error_img' => 'Возможно загрузить не более 10 фото для конкурса !']);
                exit();

            }

            foreach ($request->file('post_images') as $image) {

                $img_dop = Image::make($image);
                $img_dop_tumb = Image::make($image);
                $name_original = $image->getClientOriginalName();

                $height = $img_dop->getHeight();
                $width = $img_dop->getWidth();
                if ($width == $height && $width >= 1280) {

                    $img->resize(1280, 1280, function ($constraint) {
                        $constraint->aspectRatio();

                    });


                } else {


                    $img_dop->resize(($height < $width ? 1280 : 'NULL'), ($height > $width ? 720 : 'NULL'), function ($constraint) {
                        $constraint->aspectRatio();

                    });
                }




                //    $img_dop = CreatImage::creat_img($img_dop, 819, 546);
                $img_dop_tumb = $img_dop_tumb->fit( 100, 100);


                $file = 'fotokonkurs-' . Transliterate::slugify($name_original) . '-' . time() . '-' . $post->id . '.jpg';


                $img_dop->save(storage_path('app/public/fotokonkurs_image/' . $file));
                $img_dop_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));

                $dop_image = new FotoKonkursImage();
                $dop_image->img = $file;
                $dop_image->uchastnik_id = $post->id;

                $dop_image->save();
            }


        }


        $post->save();


        return redirect(route('uchastniki-fotokonkursov.index'))->with(['success' => 'Участник успешно добавлен!']);
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
    public function edit(FotoKonkursMaterial $uchastniki_fotokonkursov)
    {
        $konkurses = Fotokonkurs::orderBy('created_at', 'DESC')->get();

        return view('admin.fotokonkurs_materials.edit', [
            'konkurses' => $konkurses,
            'post' => $uchastniki_fotokonkursov, 'categories'=>FotoKonkursMaterial::getCategories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, FotoKonkursMaterial $uchastniki_fotokonkursov)
    {

        // dd($request->post_images);
        $novost=$uchastniki_fotokonkursov;
        $novost->title = $request->title;
        $novost->text = $request->text;
        $novost->alias = $request->alias;
        $novost->description = $request->description;
        $novost->h1 = $request->h1;
        $novost->konkurs_id = $request->konkurs_id;
        $novost->fio = $request->fio;
        $novost->email = $request->email;
        $novost->phone = $request->phone;
        $novost->category_name = $request->category_name;

        if ($request->moder)
            $novost->moder = 1;
        else
            $novost->moder = 0;
        if ($request->winer)
            $novost->winer = 1;
        else
            $novost->winer = 0;
        $date_time_mass = explode(" ", $request->created_at);
        $date_mass = explode(".", $date_time_mass[0]);
        $novost->created_at = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));
            $img_tumb = Image::make($request->file('post_image'));

            $height = $img->getHeight();
            $width = $img->getWidth();


        }


        if ($request->file('post_image') != NULL) {

            if ($novost->img) {
                if (file_exists(storage_path('app/public/fotokonkurs_image/' . $novost->img)))
                    unlink(storage_path('app/public/fotokonkurs_image/' . $novost->img));
            }


            $img = CreatImage::creat_img($img, 819, 546);
            $img_tumb = CreatImage::creat_img( $img_tumb, 300, 300);


            $file = 'fotokonkurs-' . $novost->alias . '-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
            $img_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));

        }


        // dd($request->file('post_images'));


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);

        if (isset($request->post_images) && count($request->file('post_images'))) {

            if (count($novost->images)) {
                foreach ($novost->images as $image) {
                    if (file_exists(storage_path('app/public/fotokonkurs_image/' . $image->img)))
                        unlink(storage_path('app/public/fotokonkurs_image/' . $image->img));
                    if (file_exists(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $image->img)))
                        unlink(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $image->img));

                          }
                FotoKonkursImage::where('uchastnik_id', '=', $novost->id)->delete();
                }



            foreach ($request->file('post_images') as $image) {

                $img_dop = Image::make($image);
                $img_dop_tumb = Image::make($image);
                $name_original = $image->getClientOriginalName();

                $height = $img_dop->getHeight();
                $width = $img_dop->getWidth();
                if ($width == $height && $width >= 1280) {

                    $img->resize(1280, 1280, function ($constraint) {
                        $constraint->aspectRatio();

                    });


                } else {


                    $img_dop->resize(($height < $width ? 1280 : 'NULL'), ($height > $width ? 720 : 'NULL'), function ($constraint) {
                        $constraint->aspectRatio();

                    });
                }




                //    $img_dop = CreatImage::creat_img($img_dop, 819, 546);
                $img_dop_tumb = $img_dop_tumb->fit( 100, 100);


                $file = 'fotokonkurs-' . Transliterate::slugify($name_original) . '-' . time() . '-' . $novost->id . '.jpg';

                $img_dop->save(storage_path('app/public/fotokonkurs_image/' . $file));
                $img_dop_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));

                $dop_image = new FotoKonkursImage();
                $dop_image->img = $file;
                $dop_image->uchastnik_id = $novost->id;
                $dop_image->save();
            }

        }
        if (isset($request->img_delete) && count($request->img_delete))
        {
            foreach ($request->img_delete as $id) {

               $img = FotoKonkursImage::where('id', '=', $id)->first();
                if (file_exists(storage_path('app/public/fotokonkurs_image/' . $img->img)))
                    unlink(storage_path('app/public/fotokonkurs_image/' . $img->img));
                if (file_exists(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $img->img)))
                    unlink(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $img->img));
                FotoKonkursImage::where('id', '=', $id)->delete();
            }

        }

        if (isset($request->rotate_right) && count($request->rotate_right))
        {
            foreach ($request->rotate_right as $id) {


                $img_old = FotoKonkursImage::where('id', '=', $id)->first();

                $img_ = Image::make(storage_path('app/public/fotokonkurs_image/' . $img_old->img));
                $img_tumb = Image::make(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $img_old->img));
            //    dd($img_);

                $img_ = $img_->rotate( -90);
                $img_tumb = $img_tumb->rotate(-90);
                $file = 'r-'.time().$img_old->img;
                if (file_exists(storage_path('app/public/fotokonkurs_image/' . $img_old->img)))
                    unlink(storage_path('app/public/fotokonkurs_image/' . $img_old->img));
                if (file_exists(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $img_old->img)))
                    unlink(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $img_old->img));

                $img_old->img = $file;
                $img_old->save();

                $img_->save(storage_path('app/public/fotokonkurs_image/' . $file));
                $img_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));




            }

        }


        $novost->save();
        return redirect()->back()->with(['success' => 'Участник был успешно обновлен!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(FotoKonkursMaterial $uchastniki_fotokonkursov)
    {
        $uchastniki_fotokonkursov->delete();
        return redirect()->back()->withSuccess('Участник был успешно удален!');
    }
}
