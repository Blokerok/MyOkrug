<?php

namespace App\Http\Controllers;

use App\Models\Novost;
use App\Models\Odinvopros;
use App\UserLib\CkeckUserIP;
use Illuminate\Http\Request;

class OdinvoprosController extends Controller
{
    public function index()
    {
        $materials = Odinvopros::orderBy('created_at', 'DESC')->where('report', '=', 0)->get();


        return view('materials.materials',['materials'=>$materials]);

    }



    public function material($material)
    {

        $material = Odinvopros::query()->where('alias','=',$material)->first();
        if ($material===NULL) abort('404');

        CkeckUserIP::RegVisit('App\Models\Odinvopros',$material);

        return view('materials.material_open',['material'=>$material]);

    }
}
