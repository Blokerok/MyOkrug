<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryBiznes;
use App\Models\CategoryGreen;
use App\Models\Fotokonkurs;
use App\Models\FotoKonkursMaterial;
use App\Models\GroupOpros;
use App\Models\Ludi;
use App\Models\MoyBiznes;
use App\Models\MoyDvor;
use App\Models\Novost;
use App\Models\Odinvopros;
use App\Models\Opros;
use App\Models\Ozelenenie;
use App\Models\Post;
use App\Models\Rubric;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news_count = Novost::all()->count();
        $rubrics_count = Rubric::all()->count();
        $odinvopros_count = Odinvopros::all()->count();
        $ludi_count = Ludi::all()->count();
        $cat_biz_count = CategoryBiznes::all()->count();
        $moy_biz_count = MoyBiznes::all()->count();
        $uchastnikifoto_count = FotoKonkursMaterial::all()->count();
        $fotokonkurs_count = Fotokonkurs::all()->count();
        $moyDvor_count = MoyDvor::all()->count();
        $opros_count = Opros::all()->count();
        $catgreen_count = CategoryGreen::all()->count();
        $green_count = Ozelenenie::all()->count();
        $group_count = GroupOpros::all()->count();
      //  $new_uchastnik = FotoKonkursMaterial::query()->where('moder','=',0)->count();
       // dd($new_uchastnik);


        return view('admin.home.index',
            ['news_count' => $news_count,
                'rubrics_count' => $rubrics_count,
                'odinvopros_count' => $odinvopros_count,
                'ludi_count' => $ludi_count,
                'cat_biz_count' => $cat_biz_count,
                'moy_biz_count' => $moy_biz_count,
                'uchastnikifoto_count' => $uchastnikifoto_count,
                'fotokonkurs_count' => $fotokonkurs_count,
                'moyDvor_count' => $moyDvor_count,
                'opros_count' => $opros_count,
                'catgreen_count' => $catgreen_count,
                'green_count' => $green_count,
                'group_count' => $group_count

            ]);
    }
}
