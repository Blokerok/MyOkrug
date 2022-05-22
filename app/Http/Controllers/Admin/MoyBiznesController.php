<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryBiznes;
use App\Models\MoyBiznes;
use App\Models\Moybiznesimages;
use App\Models\Novost;
use App\Models\PostImage;
use App\Models\Rubric;
use App\UserLib\CreatImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Transliterate;

class MoyBiznesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = MoyBiznes::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.moy_biznes.index', [
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
        $categories = CategoryBiznes::orderBy('created_at', 'DESC')->get();


        return view('admin.moy_biznes.create', [
            'categories' => $categories
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
            $post = session('old');
        else
            $post = new MoyBiznes();

        $post->title = $request->title;
        $post->h1 = $request->title;
        $post->description = $request->title;
        $post->text = $request->text;
        $post->category_id = $request->id_rubric;
        $post->user_id = $user->id;
        $post->type = 'biznes';


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
            $img_tumb = CreatImage::creat_img($img_tumb, 295, 197);


            $file = 'statia-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/moy_okrug_image/' . $file));
            $img_tumb->save(storage_path('app/public/moy_okrug_image/tumb/' . 'tumb-' . $file));
        }


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if (isset($request->post_images) && count($request->file('post_images'))) {

            if (count($post->images))
                foreach ($post->images as $image) {
                    unlink(storage_path('app/public/moy_okrug_image/' . $image->img));
                    unlink(storage_path('app/public/moy_okrug_image/tumb/tumb-' . $image->img));
                }

            Moybiznesimages::where('material_id', '=', $post->id)->delete();

            foreach ($request->file('post_images') as $image) {

                $img_dop = Image::make($image);
                $img_dop_tumb = Image::make($image);
                $name_original = $image->getClientOriginalName();

                $height = $img_dop->getHeight();
                $width = $img_dop->getWidth();

                if ($width < 819) {
                    return redirect()->back()->with(['error_img' => 'Дополнительное изображение ' . $name_original . ' по ширине меньше 819px, найдите изображение качественней !']);
                    break;

                }
                if ($height < 546) {
                    return redirect()->back()->with(['error_img' => 'Дополнительное изображение ' . $name_original . ' по высоте меньше 546px, найдите изображение качественней !']);
                    break;
                }


                $img_dop = CreatImage::creat_img($img_dop, 819, 546);
                $img_dop_tumb = CreatImage::creat_img($img_dop_tumb, 295, 197);


                $file = 'statia-' . Transliterate::slugify($name_original) . '-' . $post->id . '.jpg';


                $img_dop->save(storage_path('app/public/moy_okrug_image/' . $file));
                $img_dop_tumb->save(storage_path('app/public/moy_okrug_image/tumb/' . 'tumb-' . $file));

                $dop_image = new Moybiznesimages();
                $dop_image->img = $file;
                $dop_image->material_id = $post->id;

                $dop_image->save();
            }


        }

        $post->save();


        return redirect(route('moy-biznes.index'))->with(['success' => 'Статья была успешно добавлена!']);
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
    public function edit(MoyBiznes $moy_bizne)
    {
        $categories = CategoryBiznes::orderBy('created_at', 'DESC')->get();

        return view('admin.moy_biznes.edit', [
            'categories' => $categories,
            'post' => $moy_bizne,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, MoyBiznes $moy_bizne)
    {

        // dd($request->post_images);
        $novost = $moy_bizne;
        $novost->title = $request->title;
        $novost->text = $request->text;
        $novost->category_id = $request->id_rubric;
        $novost->alias = $request->alias;
        $novost->description = $request->description;
        $novost->h1 = $request->h1;
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

            if ($width < 819) {
                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 819px, найдите изображение качественней !']);

            }
            if ($height < 546) {
                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 546px, найдите изображение качественней !']);
            }

        }


        if ($request->file('post_image') != NULL) {

            if ($novost->img) {
                if (file_exists(storage_path('app/public/moy_okrug_image/' . $novost->img)))
                    unlink(storage_path('app/public/moy_okrug_image/' . $novost->img));
            }


            $img = CreatImage::creat_img($img, 819, 546);
            $img_tumb = CreatImage::creat_img($img_tumb, 295, 197);


            $file = 'statia-' . $novost->alias . '-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/moy_okrug_image/' . $file));
            $img_tumb->save(storage_path('app/public/moy_okrug_image/tumb/' . 'tumb-' . $file));

        }


        // dd($request->file('post_images'));


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);

        if (isset($request->post_images) && count($request->file('post_images'))) {

            if (count($novost->images))
                foreach ($novost->images as $image) {
                    unlink(storage_path('app/public/moy_okrug_image/' . $image->img));
                    unlink(storage_path('app/public/moy_okrug_image/tumb/tumb-' . $image->img));
                }

            Moybiznesimages::where('material_id', '=', $novost->id)->delete();

            foreach ($request->file('post_images') as $image) {

                $img_dop = Image::make($image);
                $img_dop_tumb = Image::make($image);
                $name_original = $image->getClientOriginalName();

                $height = $img_dop->getHeight();
                $width = $img_dop->getWidth();

                if ($width < 819) {
                    return redirect()->back()->with(['error_img' => 'Дополнительное изображение ' . $name_original . ' по ширине меньше 819px, найдите изображение качественней !']);
                    break;

                }
                if ($height < 546) {
                    return redirect()->back()->with(['error_img' => 'Дополнительное изображение ' . $name_original . ' по высоте меньше 546px, найдите изображение качественней !']);
                    break;
                }

                $img_dop = CreatImage::creat_img($img_dop, 819, 546);
                $img_dop_tumb = CreatImage::creat_img($img_dop_tumb, 295, 197);

                $file = 'statia-' . Transliterate::slugify($name_original) . '-' . $novost->id . '.jpg';

                $img_dop->save(storage_path('app/public/moy_okrug_image/' . $file));
                $img_dop_tumb->save(storage_path('app/public/moy_okrug_image/tumb/' . 'tumb-' . $file));

                $dop_image = new Moybiznesimages();
                $dop_image->img = $file;
                $dop_image->material_id = $novost->id;
                $dop_image->save();
            }

        }

        $novost->save();
        return redirect(route('moy-biznes.index'))->with(['success' => 'Статья была успешно обновлена!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoyBiznes $moy_bizne)
    {
        $moy_bizne->delete();
        return redirect()->back()->withSuccess('Статья была успешно удалена!');
    }
}
