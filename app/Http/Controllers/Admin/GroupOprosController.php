<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupOpros;
use App\UserLib\CreatImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Transliterate;

class GroupOprosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = GroupOpros::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.group-opros.index', [
            'categories' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.group-opros.create');
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
            $post = new GroupOpros();

        $post->title = $request->title;
        $post->h1 = $request->title;
        $post->description = $request->title;
        $post->text_page = $request->text_page;

        $post->alias = Transliterate::slugify($request->title);




        session(['old' => $post]);


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if ($request->file('post_image') != NULL) {

            $img = Image::make($request->file('post_image'));

            $img = $img->fit('965','210');

            $file = 'oprosu-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/page_image/' . $file));
        }


        $post->save();


        return redirect(route('groupu-oprosov.index'))->with(['success' => 'Группа опросов была успешно добавлена!']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(GroupOpros $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupOpros $groupu_oprosov)
    {


        return view('admin.group-opros.edit', [
            'group' => $groupu_oprosov,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, GroupOpros $groupu_oprosov)
    {

        // dd($request->post_images);
        $novost = $groupu_oprosov;
        $novost->title = $request->title;
        $novost->text_page = $request->text_page;
        $novost->alias = $request->alias;
        $novost->description = $request->description;
        $novost->h1 = $request->h1;

        $date_time_mass = explode(" ", $request->created_at);
        $date_mass = explode(".", $date_time_mass[0]);
        $novost->created_at = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];

        if ($request->stop)
            $novost->stop = 1;
        else
            $novost->stop = 0;


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        /*  if ($request->file('post_image') != NULL) {


             $height = $img->getHeight();
             $width = $img->getWidth();


         }
    */

        if ($request->file('post_image') != NULL) {

            $img = Image::make($request->file('post_image'));

            if ($novost->img) {
                if (file_exists(storage_path('app/public/page_image/' . $novost->img)))
                    unlink(storage_path('app/public/page_image/' . $novost->img));
            }

            $img = $img->fit('965','210');



            // $img_tumb = CreatImage::creat_img($img_tumb, 295, 197);


            $file = 'oprosu-' . $novost->alias . '-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/page_image/' . $file));


        }


        // dd($request->file('post_images'));


        $novost->save();
        return redirect(route('groupu-oprosov.index'))->with(['success' => 'Страница была успешно обновлена!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupOpros $groupu_oprosov)
    {
       // $page->delete();
       // return redirect()->back()->withSuccess('Cтраница была успешно удалена!');
    }
}
