<?php

namespace App\Http\Controllers;

use App\Models\Novost;
use App\Models\Ludi;
use App\Models\Odinvopros;
use App\Models\MoyBiznes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Liked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function SetLike(Request $request)
    {
        $user = Auth::user();
        switch ($request->model)
        {
            case 'Novost':  $model   = new Novost(); break;
            case 'Ludi':  $model   = new Ludi(); break;
            case 'Odinvopros':  $model   = new Odinvopros(); break;
            case 'MoyBiznes':  $model   = new MoyBiznes(); break;
        }

        $obj = $model::query()->where('id','=',$request->id)->first();
        $present = $obj->like;
        if (!count($present)) {
            $voice = new Liked();
            $voice->likedable_id = $request->id;
            $voice->likedable_type = 'App\Models'.'\\'.$request->model;
            $voice->user_id = $user->id;
            $voice->save();

            $model::query()->where('id', '=', $request->id)->increment('likes');
            echo 1;
        } else {

            echo 0;
        }


    }

    public function UnsetLike(Request $request)
    {

        switch ($request->model)
        {

            case 'Novost':  $model   = new Novost(); break;
            case 'Ludi':  $model   = new Ludi(); break;
            case 'Odinvopros':  $model   = new Odinvopros(); break;
            case 'MoyBiznes':  $model   = new MoyBiznes(); break;
        }

        $obj = $model::query()->where('id','=',$request->id)->first();
        $present = $obj->like;
        if (count($present)) {
            $present[0]->delete();

            $model::query()->where('id', '=', $request->id)->decrement('likes');
            echo 1;
        } else {

            echo 0;
        }


    }
}
