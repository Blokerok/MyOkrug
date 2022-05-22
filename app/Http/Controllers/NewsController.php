<?php

namespace App\Http\Controllers;

use App\UserLib\AuthCackle;
use App\Models\Novost;
use App\Models\Rubric;
use App\UserLib\CkeckUserIP;

class NewsController extends Controller {
    public function index() {
        $news = Novost::query()->where('public', '=', 1)->where('report', '=', 0)->orderBy('created_at', 'DESC')->get();
        //  dd($news);
        return view('news.news', ['news' => $news]);

    }

    public function rubrica($rubric) {
        $rubrica = Rubric::query()->where('alias', '=', $rubric)->first();

        if ($rubrica === NULL)
            abort('404');
        $news_rubric = $rubrica->news;

        return view('news.news', ['news' => $news_rubric, 'rubrica' => $rubrica]);

    }

    public function new_open($rubric, $novost) {


        $rubrica = Rubric::query()->where('alias', '=', $rubric)->first();
        if ($rubrica === NULL)
            abort('404');
        $novost = Novost::query()->where('alias', '=', $novost)->where('public', '=', 1)->first();

        if ($novost === NULL)
            abort('404');

        CkeckUserIP::RegVisit('App\Models\Novost', $novost);

        $other_news = $novost->category->news->where('id', '!=', $novost->id)->take(3);

        AuthCackle::login_cackle();

        return view('news.new_open', ['novost' => $novost, 'rubrica' => $rubrica, 'other_news' => $other_news]);

    }

}
