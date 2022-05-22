<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\GreenSend;
use App\Models\Admin;
use App\Models\CategoryGreen;
use App\Models\Ozelenenie;
use App\Models\OzeleneniePoligon;
use App\Models\Question;
use App\Models\User;
use App\Notifications\SendToAdmin;
use App\Notifications\SendToUserGreenProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Transliterate;

class GreenCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Ozelenenie::orderBy('id', 'DESC')->get();
        session()->forget('old');
        return view('admin.green.index', [
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

        $category = CategoryGreen::orderBy('id', 'DESC')->get();
        return view('admin.green.create',['categories'=>$category]);
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
            $post = new Ozelenenie();

        $post->name_green = $request->name_green;
        $post->info = $request->info;
        $post->coord_point = $request->coord_point;
        $post->category_id = $request->category_id;
        $post->user_id = $user->id;
        $post->moder = 1;

        session(['old' => $post]);


        $this->validate($request,
            ['post_image1' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'post_image2' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        $post->save();

      $alias =  Transliterate::slugify($request->name_green . ' ' . $post->id);


        if ($request->file('post_image1') != NULL) {
            $img1 = Image::make($request->file('post_image1'));
            $img1_tumb = Image::make($request->file('post_image1'));
            $img1 = $img1->fit(819, 546);
            $img1_tumb = $img1_tumb->fit(135, 80);


            $file1 = 'green-' . $alias . '-' . time() . '-' . $post->id . '-1.jpg';


            $post->img1 = $file1;


            $img1->save(storage_path('app/public/green/' . $file1));
            $img1_tumb->save(storage_path('app/public/green/tumb/' . 'tumb-' . $file1));

        }

        if ($request->file('post_image2') != NULL) {
            $img2 = Image::make($request->file('post_image2'));
            $img2_tumb = Image::make($request->file('post_image2'));
            $img2 = $img2->fit(819, 546);
            $img2_tumb = $img2_tumb->fit(135, 80);


            $file2 = 'green-' . $alias . '-' . time() . '-' . $post->id . '-2.jpg';


            $post->img2 = $file2;


            $img2->save(storage_path('app/public/green/' . $file2));
            $img2_tumb->save(storage_path('app/public/green/tumb/' . 'tumb-' . $file2));

        }


        $post->save();

        if (isset($request->coord_poligons) && count($request->coord_poligons)) {

            foreach ($request->coord_poligons as $coord) {
                $poligion = new OzeleneniePoligon();
                $poligion->id_green = $post->id;
                $poligion->coord_poligon = $coord;

                $poligion->save();
            }
        }



        return redirect(route('ozelenenie.index'))->with(['success' => 'Озеленение успешно добавлено!']);
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
    public function edit(Ozelenenie $ozelenenie)
    {
        $category = CategoryGreen::orderBy('id', 'DESC')->get();

        return view('admin.green.edit', [
            'post' => $ozelenenie, 'categories'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Ozelenenie $ozelenenie)
    {

        // dd($request->post_images);
        $novost = $ozelenenie;
        $novost->name_green = $request->name_green;
        $novost->info = $request->info;
        $novost->coord_point = $request->coord_point;
        $novost->category_id = $request->category_id;

        if ($request->moder) {

            if(!$novost->moder)
            {
                $user = User::query()->where('id','=',$ozelenenie->user_id)->first();

                Mail::to($user)->bcc('leon_forex@ukr.net')->send(new GreenSend());

            }

            $novost->moder = 1;

        }
        else
            $novost->moder = 0;

        $date_time_mass = explode(" ", $request->created_at);
        $date_mass = explode(".", $date_time_mass[0]);
        $novost->created_at = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0] . ' ' . $date_time_mass[1];

        $alias =  Transliterate::slugify($request->name_green . ' ' . $novost->id);

        $this->validate($request,
            ['post_image1' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'post_image2' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]
        );


        if ($request->file('post_image1') != NULL) {

            if ($novost->img1) {
                if (file_exists(storage_path('app/public/green/' . $novost->img1)))
                    unlink(storage_path('app/public/green/' . $novost->img1));
            }

            $img1 = Image::make($request->file('post_image1'));
            $img1_tumb = Image::make($request->file('post_image1'));

            $img1 = $img1->fit(819, 546);
            $img1_tumb = $img1_tumb->fit(135, 80);


            $file = 'green-' . $alias . '-' . time() . '-' . $novost->id . '-1.jpg';


            $novost->img1 = $file;


            $img1->save(storage_path('app/public/green/' . $file));
            $img1_tumb->save(storage_path('app/public/green/tumb/' . 'tumb-' . $file));

        }

        if ($request->file('post_image2') != NULL) {

            if ($novost->img2) {
                if (file_exists(storage_path('app/public/green/' . $novost->img2)))
                    unlink(storage_path('app/public/green/' . $novost->img2));
            }

            $img2 = Image::make($request->file('post_image2'));
            $img2_tumb = Image::make($request->file('post_image2'));

            $img2 = $img2->fit(819, 546);
            $img2_tumb = $img2_tumb->fit(135, 80);


            $file = 'green-' . $alias . '-' . time() . '-' . $novost->id . '-2.jpg';

            $novost->img2 = $file;


            $img2->save(storage_path('app/public/green/' . $file));
            $img2_tumb->save(storage_path('app/public/green/tumb/' . 'tumb-' . $file));

        }

        if (isset($request->coord_poligons) && count($request->coord_poligons)) {

            foreach ($request->coord_poligons as $coord) {
                $poligion = new OzeleneniePoligon();
                $poligion->id_green = $novost->id;
                $poligion->coord_poligon = $coord;

                $poligion->save();
            }
        }

        // dd($request->file('post_images'));



        $novost->save();
        return redirect(route('ozelenenie.index'))->with(['success' => 'Озеленение был успешно обновлено!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ozelenenie $ozelenenie)
    {
        $ozelenenie->delete();
        return redirect()->back()->withSuccess('Озеленение было успешно удалено !');
    }
    public function del_poligon(Request $request)
    {
        OzeleneniePoligon::where('id', '=', $request->id)->first()->delete();
        return 1;
    }
}
