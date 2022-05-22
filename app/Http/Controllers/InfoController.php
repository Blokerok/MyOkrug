<?php

namespace App\Http\Controllers;

use App\Models\Baner;
use App\Models\InfoRubric;


class InfoController extends Controller {
    public function index() {
        $rubrics = InfoRubric::query()->orderBy('created_at', 'DESC')->get();
        $banners = Baner::orderBy('id', 'DESC')->where('for_info', '1')->get();

        //  dd($news);
        return view('info.home', ['rubrics' =>  $rubrics, 'banners'=>$banners]);

    }

}
