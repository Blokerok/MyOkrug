<?php

namespace App\Http\Controllers;

use App\Models\CategoryBiznes;
use App\Models\MoyBiznes;
use App\UserLib\CkeckUserIP;
use Illuminate\Http\Request;

class MoyBiznessController extends Controller
{
    public function index()
    {
        $news = MoyBiznes::orderBy('created_at', 'DESC')->get();


        return view('moy_biznes.news',['news'=>$news]);

    }

    public function сategory($category)
    {
        $rubrica = CategoryBiznes::query()->where('alias','=',$category)->first();

        if ($rubrica===NULL) abort('404');
        $news_rubric = $rubrica->news;

        return view('moy_biznes.news',['news'=>$news_rubric,'rubrica'=>$rubrica]);

    }

    public function post_open($category,$post)
    {
        $rubrica = CategoryBiznes::query()->where('alias','=',$category)->first();
        if ($rubrica===NULL) abort('404');
        $novost = MoyBiznes::query()->where('alias','=',$post)->first();
        if ($novost===NULL) abort('404');

        CkeckUserIP::RegVisit('App\Models\MoyBiznes',$novost);

        $other_news = $novost->category->news->where('id','!=',$novost->id)->take(3);

        return view('moy_biznes.new_open',['novost'=>$novost,'rubrica'=>$rubrica,'other_news'=>$other_news]);

    }
}
