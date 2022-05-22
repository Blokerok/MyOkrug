<?php

namespace App\Http\Controllers;

use App\Models\MoyDvor;
use App\UserLib\CkeckUserIP;

class DvorController extends Controller
{
    public function index()
    {
        $materials = MoyDvor::orderBy('created_at', 'DESC')->get();

        $coords = [];

        foreach ($materials as $dvor)
        {
            $coords[] = ['coord'=>explode(',',$dvor->coord),'baloon'=>'<img width="32" src="/public/images/moy-dvor.png"/><h2>'.$dvor['h1'].'</h2><a href="/moy-dvor/'.$dvor['alias'].'">Перейти в двор</a>'];

        }

        $coords = json_encode($coords);

        return view('moy_dvor.dvors',['dvors'=>$materials,'coords'=>$coords]);

    }



    public function material($material)
    {

        $material = MoyDvor::query()->where('alias','=',$material)->first();

        if ($material===NULL) abort('404');

        CkeckUserIP::RegVisit('App\Models\MoyDvor',$material);

        return view('moy_dvor.dvor_open',['novost'=>$material]);

    }
}
