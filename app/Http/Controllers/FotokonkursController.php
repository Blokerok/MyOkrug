<?php

namespace App\Http\Controllers;

use App\Models\Fotokonkurs;
use App\Models\FotoKonkursImage;
use App\Models\FotoKonkursMaterial;
use App\Models\Liked;
use App\Models\Novost;
use App\UserLib\AuthCackle;
use App\UserLib\CkeckUserIP;
use App\UserLib\CreatImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Transliterate;

class FotokonkursController extends Controller
{
    public function index()
    {
        session()->forget('old');
        $news_top = Novost::orderBy('visits', 'DESC')->take(5)->get();
        $present_konkurs = Fotokonkurs::query()->where('stop', '=', 0)->orderBy('id', 'DESC')->get();
        $stop_konkurs = Fotokonkurs::query()->where('stop', '=', 1)->orderBy('id', 'DESC')->get();


        return view('fotokonkurs.fotokonkurs', ['top_news' => $news_top, 'present_konkurs' => $present_konkurs, 'stop_konkurs' => $stop_konkurs]);
    }

    public function list_uchastniki($conkurs)
    {
        $konkurs_ = Fotokonkurs::query()->where('alias', '=', $conkurs)->first();
        if ($konkurs_ === NULL) abort('404');

        if ($konkurs_->stop)
            $uchasthiki = $konkurs_->uchastniki_stop;
        else
            $uchasthiki = $konkurs_->uchastniki->where('moder', '=', 1);


        AuthCackle::login_cackle();
        session()->put('user_url',URL::current());

        $tabs = [];
        if($konkurs_->category_need) {
            foreach ($uchasthiki as $uchastnik) {
                $tabs["Все"][] = $uchastnik;
                if (!empty($uchastnik->category_name))
                    $tabs[$uchastnik->category_name][] = $uchastnik;
            }
        }

        return view('fotokonkurs.fotokonkurs_open', ['uchasthiki' => $uchasthiki, 'konkurs' => $konkurs_,'tabs' => $tabs]);


    }


    public function uchastnik_open($conkurs, $uchastnik)
    {
        $konkurs_ = Fotokonkurs::query()->where('alias', '=', $conkurs)->first();
        if ($konkurs_ === NULL) abort('404');
        $uchastnik_ = FotoKonkursMaterial::query()->where('alias', '=', $uchastnik)->first();
        if ($uchastnik_ === NULL) abort('404');

        CkeckUserIP::RegVisit('App\Models\FotoKonkursMaterial', $uchastnik_);



        AuthCackle::login_cackle();
        return view('fotokonkurs.uchastnik_open', ['uchastnik' => $uchastnik_, 'konkurs' => $konkurs_]);


    }

    public function SetVoice(Request $request)
    {
        $user = Auth::user();
        $uchachstnik = FotoKonkursMaterial::query()->where('id', '=', $request->id)->first();
        $present = $uchachstnik->voice;
        if (!count($present)) {
            $voice = new Liked();
            $voice->likedable_id = $request->id;
            $voice->likedable_type = 'App\Models\FotoKonkursMaterial';
            $voice->user_id = $user->id;
            $voice->save();

            FotoKonkursMaterial::query()->where('id', '=', $request->id)->increment('likes');
            echo 1;
        } else {

            echo 0;
        }


    }


    public function fotokonkurs_add($konkurs)
    {

        $konkurs_ = Fotokonkurs::query()->where('id', '=', $konkurs)->select(['h1', 'id', 'alias', 'stop'])->first();

        if ($konkurs_->stop) abort('404');
        //$news_top = Novost::orderBy('visits', 'DESC')->take(5)->get();


        return view('fotokonkurs.new_uchastnik', ['konkurs' => $konkurs_, 'categories'=>FotoKonkursMaterial::getCategories()]);

    }

    public function creat_uchastnik(Request $request)
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

        session(['old' => $post]);


        $this->validate($request,
            ['post_image' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096'],
                'fio' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:200'],
                'title' => ['required', 'string'],
                'text' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'post_images' => ['array'],
                'post_images.*' => ['mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);


        $post->save();

        $post->alias = Transliterate::slugify($request->title . ' ' . $post->id);


        if ($request->file('post_image') != NULL) {
            $img = Image::make($request->file('post_image'));
            $img_tumb = Image::make($request->file('post_image'));

            $height = $img->getHeight();
            $width = $img->getWidth();

            if ($width == $height && $width >= 1280) {
                $img->resize(1280, 1280, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize(($height < $width ? 1280 : 'NULL'), ($height > $width ? 720 : 'NULL'), function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            //   $img = CreatImage::creat_img($img, 819, 546);
            $img_tumb = CreatImage::creat_img($img_tumb, 300, 300);


            $file = 'fotokonkurs-' . $post->alias . '-' . time() . '-' . $post->id . '.jpg';


            $post->img = $file;


            $img->save(storage_path('app/public/fotokonkurs_image/' . $file));
            $img_tumb->save(storage_path('app/public/fotokonkurs_image/tumb/' . 'tumb-' . $file));
        }


        if (isset($request->post_images) && count($request->file('post_images'))) {


            if (count($post->images)) {
                foreach ($post->images as $image) {


                    if (file_exists(storage_path('app/public/fotokonkurs_image/' . $image->img)))
                        unlink(storage_path('app/public/fotokonkurs_image/' . $image->img));
                    if (file_exists(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $image->img)))
                        unlink(storage_path('app/public/fotokonkurs_image/tumb/tumb-' . $image->img));
                }

                FotoKonkursImage::where('uchastnik_id', '=', $post->id)->delete();
            }


            if (count($request->file('post_images')) > 10) {
                return redirect()->back()->with(['error_img2' => 'Возможно загрузить не более 10 фото для конкурса !']);
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


                    $img->resize(($height < $width ? 1280 : 'NULL'), ($height > $width ? 720 : 'NULL'), function ($constraint) {
                        $constraint->aspectRatio();

                    });
                }


                //    $img_dop = CreatImage::creat_img($img_dop, 819, 546);
                $img_dop_tumb = CreatImage::creat_img($img_dop_tumb, 100, 100);


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


        return redirect()->route('LinkKonkurs', [$request->alias])->with(['success' => 'Вы успешно добавили свои материалы для участия в конкурсе! Если материалы удовлетворяют условиям конкурса, то они в скором времени будут размещены и примут участие в голосовании.']);
    }
}
