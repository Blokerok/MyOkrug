<?php

namespace App\Http\Controllers;

use App\Models\CategoryGreen;
use App\Models\GreenVoice;
use App\Models\Ozelenenie;
use App\Models\OzeleneniePoligon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Transliterate;

class GreenController extends Controller
{

    public function index()
    {
        $points = Ozelenenie::query()->where('moder','=',1)->orderBy('created_at', 'DESC')->get();
        $poligons = OzeleneniePoligon::orderBy('created_at', 'DESC')->get();

        session()->forget('old');

        session()->put('user_url',URL::current());

        return view('green.index',['points'=>$points,'poligons'=>$poligons]);

    }

    public function creat_green()
    {

        $category = CategoryGreen::orderBy('id', 'DESC')->get();
        return view('green.new_green',['categories'=>$category]);
    }

    public function store_green(Request $request)
    {

        $category = CategoryGreen::orderBy('id', 'DESC')->get();

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
        $post->moder = 0;

        session(['old' => $post]);


        $this->validate($request,
            ['post_image1' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'post_image2' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'coord_point' => ['required', 'string', 'max:100', 'regex:/^[\d]{2}\.[\d]+\,[\d]{2}\.[\d]+$/ism'],
                'info' => ['required', 'string', 'max:300'],
                'name_green' => ['required', 'string','max:100'],
                'category_id' => ['required']]);

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

        return redirect(route('indexGreen'))->with(['success' => 'Озеленение успешно добавлено!<br />После проверки модератором, Ваша заявка будет размещена на карте.']);
    }

    public function save_voice (Request $request)
    {    $user = Auth::user();
        $present = GreenVoice::query()->where('id_green','=',$request->id_green)->where('user_id','=',$user->id)->count();
        if ($present)
        {
            echo '<b style="color:red">Вы уже проглосовали, спасибо!</b>';
        }

        else if ($request->voice=='button-yes' || $request->voice=='button-no') {


            $voice = new GreenVoice();
            $voice->user_id = $user->id;
            $voice->id_green = $request->id_green;

            if ($request->voice=='button-yes')
            {
                $voice->yes = 1;
            }
            else
            {
                $voice->no = 1;
            }
            $voice->save();

            echo 'Ваш голос учтен!';
        }
        else
        {
            echo '<b style="color:red">По техническим причинам голос не учтен.</b>';
        }

    }
}
