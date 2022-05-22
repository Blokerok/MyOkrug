<?php

namespace App\Http\Controllers;


use App\Models\Baner;
use App\Models\Novost;
use App\Models\Odinvopros;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news_last = Novost::query()->where('public','=',1)->where('report', '=', 0)->orderBy('created_at', 'DESC')->take(4)->get();
        $materials = Odinvopros::orderBy('created_at', 'DESC')->where('report', '=', 0)->take(3)->get();
        $new_last = Novost::query()->where('public','=',1)->where('report', '=', 0)->orderBy('created_at', 'DESC')->first();
        $new_of_day = Novost::query()->where('public','=',1)->where('report', '=', 0)->where('new_day', 1)->orderByDesc('created_at')->get();
        $baner1 = Baner::where('id','=','1')->first();
        $baner2 = Baner::where('id','=','2')->first();


        $moy_biznes =  DB::table('moy_biznes')->leftJoin('category_biznes', 'category_biznes.id', '=', 'moy_biznes.category_id')
            ->select(['moy_biznes.id','moy_biznes.h1','moy_biznes.created_at','moy_biznes.alias','moy_biznes.img','moy_biznes.type','category_biznes.alias as category_alias']);

          //    dd($moy_biznes);

               $moy_okrug = DB::table('ludis')->select(['id','h1','created_at','alias','img','type','category_id as category_alias'])
                   ->union($moy_biznes)->orderByDesc('created_at')->take(3)
                   ->get();



     //   dd($moy_okrug_image);
      //  $moy_okrug = [];

       return view('welcome',['news_last'=>$news_last,'new_last'=>$new_last,'new_of_day'=>$new_of_day,'materials'=>$materials,'moy_okrug'=>$moy_okrug,'baner1'=>$baner1,'baner2'=>$baner2]);

    }
}
