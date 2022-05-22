<?php

namespace App\Providers;

use App\Models\Fotokonkurs;
use App\Models\FotoKonkursMaterial;
use App\Models\Novost;
use App\Models\Ozelenenie;
use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerAdminParam extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.admin_layout', function($view) {
            $view->with(['new_uchastnik' => FotoKonkursMaterial::query()->where('moder','=',0)->count(),
            'new_point' => Ozelenenie::query()->where('moder','=',0)->count()]);
        });



        View::composer('layouts.right_block', function($view) {

            $foto_kon_top3 = Fotokonkurs::query()->where('stop','=',0)->orderBy('created_at','DESC')->take(3)->get();
            $top_news = Novost::query()->where('public','=',1)->orderBy('visits', 'DESC')->take(5)->get();

            $view->with(['top_news' => $top_news,'foto_kon_top3'=>$foto_kon_top3]);
        });

        View::composer('layouts.app_face', function($view) {
            $segment = request()->segment(1);

            $view->with(['segment' => $segment]);
        });



    }
}
