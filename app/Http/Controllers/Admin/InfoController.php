<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Models\PostImage;
use App\Models\InfoRubric;
use App\UserLib\CreatImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Transliterate;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Info::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.info.index', [
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
        $categories = InfoRubric::orderBy('created_at', 'DESC')->get();


        return view('admin.info.create', [
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
            $post = new Info();

        $post->title = $request->title;
        $post->rubric_id = $request->rubric_id;
        $post->phone = $request->phone;
        $post->sait = $request->sait;
        $post->social_telegram = $request->social_telegram;
        $post->social_ok = $request->social_ok;
        $post->social_vk = $request->social_vk;

        session(['old' => $post]);


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);

        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));
            

            $height = $img->getHeight();
            $width = $img->getWidth();

//            if ($width < 819) {
//                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 819px, найдите изображение качественней !']);
//
//            }
//            if ($height < 546) {
//                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 546px, найдите изображение качественней !']);
//            }

        }

        $post->save();



        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));

            $img = CreatImage::creat_img($img, 58, 58);


            $file = 'info-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/info_image/' . $file));

        }


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        $post->save();


        return redirect(route('info.index'))->with(['success' => 'Позиция была успешно добавлена!']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Info $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        $categories = InfoRubric::orderBy('created_at', 'DESC')->get();

        return view('admin.info.edit', [
            'categories' => $categories,
            'post' => $info,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Info $info)
    {
        $post = $info;
        // dd($request->post_images);
        $post->title = $request->title;
        $post->rubric_id = $request->rubric_id;
        $post->phone = $request->phone;
        $post->sait = $request->sait;
        $post->social_telegram = $request->social_telegram;
        $post->social_ok = $request->social_ok;
        $post->social_vk = $request->social_vk;

            if ($request->public)
            $post->public = 1;
        else
            $post->public = 0;


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));
            $img_tumb = Image::make($request->file('post_image'));

            $height = $img->getHeight();
            $width = $img->getWidth();

//            if ($width < 819) {
//                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 819px, найдите изображение качественней !']);
//
//            }
//            if ($height < 546) {
//                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 546px, найдите изображение качественней !']);
//            }

        }


        if ($request->file('post_image') != NULL) {

            if ($post->img) {
                if (file_exists(storage_path('app/public/info_image/' . $post->img)))
                    unlink(storage_path('app/public/info_image/' . $post->img));
            }


            $img = CreatImage::creat_img($img, 58, 58);


            $file = 'info-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/info_image/' . $file));


        }


        // dd($request->file('post_images'));


        $this->validate($request, [
            'post_images' => ['array'],
            'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);



        $post->save();
        return redirect(route('info.index'))->with(['success' => 'Статья была успешно обновлена!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        $info->delete();
        return redirect()->back()->withSuccess('Статья была успешно удалена!');
    }
}
