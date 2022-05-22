<?php

namespace App\Http\Controllers;

use App\Models\GroupOpros;
use App\Models\Opros;
use App\Models\Vopros;
use App\UserLib\AuthCackle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class OprosController extends Controller
{
    public function index()
    {
        $present_oproses = GroupOpros::query()->where('stop','=',0)->orderBy('created_at', 'desc')->get();
        $stop_oproses =  GroupOpros::query()->where('stop','=',1)->orderBy('created_at', 'desc')->get();

        return view('oprosu.oproses', [
            'present_oproses' => $present_oproses,
            'stop_oproses' => $stop_oproses

        ]);
    }
    public function opros($opros)

    {
        session()->put('user_url',URL::current());
        $oprosu = [];
        $iam_voises = [];
        $statistik_opros = [];

        $group = GroupOpros::query()->where('alias','=',$opros)->first();
        $oprosu = Opros::query()->where('group_id','=',$group->id)->get();



        foreach ($oprosu as $opros) {
            $iam_voises[$opros->id] = 0;
            // dump($opros->voproses);
            foreach ($opros->voproses_face as $vopros) {
                if ($iam_voises[$opros->id] == 1) break;

                if (count($vopros->voices_)) {
                    foreach ($vopros->voices_ as $voice)
                        if (Auth::check() && Auth::user()->id == $voice->user_id) {
                            $iam_voises[$opros->id] = 1;
                            break;
                        }
                }
            }

        }

        foreach ($oprosu as $opros) {

            $total_voises = Vopros::query()->where('opros_id', '=', $opros->id)->sum('voices');
            $statistik_opros[$opros->id]['total'] = $total_voises;
            $voproses = $opros->voproses_face;
            foreach ($voproses as $vopros) {

                $statistik_opros[$opros->id][$vopros->id]['persent'] = (int)($vopros->voices ? $vopros->voices / $total_voises * 100 : 0);


            }

        }

        AuthCackle::login_cackle();

        return view('oprosu.opros', [
            'oprosu' => $oprosu,
            'iam_voises' => $iam_voises,
            'statistik_opros' => $statistik_opros,
            'group' => $group

        ]);
    }
}
