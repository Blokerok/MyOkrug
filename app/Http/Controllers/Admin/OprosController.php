<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baner;
use App\Models\GroupOpros;
use App\Models\Opros;
use App\Models\Page;
use App\Models\Pageimage;
use App\Models\Vopros;
use App\UserLib\CreatImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Null_;

class OprosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oproses = Opros::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.oprosu.index', [
            'oproses' => $oproses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = GroupOpros::all();

        return view('admin.oprosu.create', ['categories' => $data]);
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
            $post = new Opros();

        $post->title = $request->title;
        $post->text = $request->text;
        $post->group_id = $request->group_id;


        if ($request->stop) {
            $date_time_mass = explode(" ", $request->stop);
            $date_mass = explode(".", $date_time_mass[0]);
            $post->stop = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];
        }


        session(['old' => $post]);


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        $post->save();

        if ($request->file('post_image') != NULL) {

            $img = Image::make($request->file('post_image'));
            $img = $img->fit(447, 173);


            $file = 'opros-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/page_image/' . $file));
        }


        foreach ($request->vopros as $item) {
            if ($item) {
                $vopros = new Vopros();
                $vopros->vopros = $item;
                $vopros->opros_id = $post->id;
                $vopros->save();
            }
        }

        if ($request->self_answer && !Vopros::query()->where('opros_id','=',$post->id)->where('self_answer','=',1)->first()) {
            $post->self_answer = 1;
            $vopros_answer = New Vopros();
            $vopros_answer->vopros = 'Свой вариант ответа';
            $vopros_answer->opros_id = $post->id;
            $vopros_answer->self_answer = 1;
            $vopros_answer->save();
        }
        else {
            $post->self_answer = null;

        }


        $post->save();


        return redirect(route('oprosu.index'))->with(['success' => 'Опрос был успешно добавлен!']);
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
    public function edit(Opros $oprosu)
    {
        $data = GroupOpros::all();

        return view('admin.oprosu.edit', [
            'post' => $oprosu, 'categories' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Opros $oprosu)
    {

        // dd($request->post_images);
        $novost = $oprosu;
        $novost->title = $request->title;
        $novost->text = $request->text;
        $novost->group_id = $request->group_id;

        $present_self_answer = Vopros::query()->where('opros_id','=',$oprosu->id)->where('self_answer','=',1)->first();


        if ($request->self_answer && !$present_self_answer) {
            $novost->self_answer = 1;
            $vopros_answer = New Vopros();
            $vopros_answer->vopros = 'Свой вариант ответа';
            $vopros_answer->opros_id = $oprosu->id;
            $vopros_answer->self_answer = 1;
            $vopros_answer->save();
        }
        elseif(!$request->self_answer && $present_self_answer) {

            $novost->self_answer = null;
            $present_self_answer->delete();
        }

        $date_time_mass = explode(" ", $request->created_at);
        $date_mass = explode(".", $date_time_mass[0]);
        $novost->created_at = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];

        if ($request->stop) {
            $date_time_mass = explode(" ", $request->stop);
            $date_mass = explode(".", $date_time_mass[0]);
            $novost->stop = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];
        }

        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        if ($request->file('post_image') != NULL) {

            $img = Image::make($request->file('post_image'));

            if ($novost->img) {
                if (file_exists(storage_path('app/public/page_image/' . $novost->img)))
                    unlink(storage_path('app/public/page_image/' . $novost->img));
            }

            $img = $img->fit(447, 173);


            $file = 'opros-' . time() . '-' . $novost->id . '.jpg';


            $novost->img = $file;


            $img->save(storage_path('app/public/page_image/' . $file));


        }
      //dd($request->old_vopros);
        foreach ($request->old_vopros as $key => $vopros_new) {
            if ($vopros_new) {
                $vopros_old = Vopros::where('id', '=', $key)->first();
                $vopros_old->self_answer = null;
                $vopros_old->vopros = $vopros_new;
                $vopros_old->update();
            }
        }

        foreach ($request->vopros as $item) {
            if ($item) {
                $vopros = new Vopros();
                $vopros->vopros = $item;
                $vopros->self_answer = null;
                $vopros->opros_id = $novost->id;
                $vopros->save();
            }
        }


        $novost->update();
        return redirect(route('oprosu.index'))->with(['success' => 'Опрос был успешно обновлен!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opros $oprosu)
    {
        $oprosu->delete();
        return redirect()->back()->withSuccess('Опрос был успешно удален!');
    }

    public function del_vopros(Request $request)
    {
        Vopros::where('id', '=', $request->id)->first()->delete();
        return 1;
    }


}
