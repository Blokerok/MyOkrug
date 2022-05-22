<?php

namespace App\Http\Controllers;

use App\Models\Ludi;
use App\Models\Novost;

use App\UserLib\CkeckUserIP;
use Illuminate\Http\Request;

class LudiController extends Controller
{
    public function index()
    {
        $materials = Ludi::orderBy('created_at', 'DESC')->get();


        return view('ludi_okruga.materials',['materials'=>$materials]);

    }



    public function material($material)
    {

        $material = Ludi::query()->where('alias','=',$material)->first();

        if ($material===NULL) abort('404');

        CkeckUserIP::RegVisit('App\Models\Ludi',$material);

        return view('ludi_okruga.material_open',['novost'=>$material]);

    }
}
