<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Odinvopros;
use App\Models\PostImage;
use App\Models\Rubric;
use App\UserLib\CreatImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Transliterate;

class OdinvoprosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Odinvopros::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.odinvopros.index', [
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



        return view('admin.odinvopros.create');
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
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",$request->link_youtube,$link);

        if (session()->has('old'))
            $post = session('old');
        else
            $post = new Odinvopros();

        $post->title = $request->title;
        $post->h1 = $request->title;
        $post->description = $request->title;
        $post->link_youtube  = 'https://www.youtube.com/embed/'.$link[1];
        $post->text = $request->text;
        $post->user_id = $user->id;
        if ($request->report)
            $post->report = 1;
        else
            $post->report = 0;

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


            $file = 'novost-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/odinvopros_image/' . $file));
            $img_tumb->save(storage_path('app/public/odinvopros_image/tumb/' . 'tumb-' . $file));
        }



        $post->save();


        return redirect(route('odinvopros.index'))->with(['success' => 'Материал успешно добавлен!']);
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
    public function edit(Odinvopros $odinvopro)
    {


        return view('admin.odinvopros.edit', [
            'post' => $odinvopro,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Odinvopros $odinvopro)
    {
        $novost = $odinvopro;
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",$request->link_youtube,$link);
        // dd($request->post_images);
        $novost->title = $request->title;
        $novost->text = $request->text;
        $novost->alias = $request->alias;
        $novost->description = $request->description;
        $novost->link_youtube  = 'https://www.youtube.com/embed/'.$link[1];
        $novost->h1 = $request->h1;
        if ($request->report)
            $novost->report = 1;
        else
            $novost->report = 0;


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
                if (file_exists(storage_path('app/public/odinvopros_image/' . $novost->img)))
                    unlink(storage_path('app/public/odinvopros_image/' . $novost->img));
            }


            $img = CreatImage::creat_img($img, 819, 546);
            $img_tumb = CreatImage::creat_img( $img_tumb, 295, 197);


            $file = 'reportazh-' . $novost->alias . '-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/odinvopros_image/' . $file));
            $img_tumb->save(storage_path('app/public/odinvopros_image/tumb/' . 'tumb-' . $file));

        }


        $novost->save();
        return redirect(route('odinvopros.index'))->with(['success' => 'Материал был успешно обновлен!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Odinvopros $odinvopro)
    {
        $odinvopro->delete();
        return redirect()->back()->withSuccess('Материал был успешно удален!');
    }
}
