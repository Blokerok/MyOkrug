<?php

use App\Models\FotoKonkursMaterial;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Cabinet;
use App\Http\Controllers\Admin;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [HomeController::class,'index']);


Auth::routes(['verify'=>true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/service', [ServiceController::class, 'index'])->name('service');

Route::middleware(['role:user|admin'])->prefix('cabinet')->group(function () {
    Route::get('/', [Cabinet\HomeController::class, 'index'])->name('homeCabinet'); // user
    Route::post('/update', [Cabinet\HomeController::class, 'update'])->name('update_data_user'); // user
    Route::post('/send_form', [Cabinet\HomeController::class, 'mailToAdmin'])->name('send_form');
    Route::post('/save_avatar', [Cabinet\HomeController::class, 'save_avatar'])->name('save_avatar'); // user
    Route::get('/del_avatar', [Cabinet\HomeController::class, 'del_avatar'])->name('delete_avatar');
    Route::post('/send_mess_glava', [\App\Http\Controllers\PageController::class, 'mailToGlava'])->name('send_for_glava');
    Route::post('/save-voice', [\App\Http\Controllers\PageController::class, 'save_voice'])->name('save_voice');

   // Route::resource('rubric', CategoryController::class);
  //  Route::resource('novost', PostController::class);
});

Route::middleware(['role:user|admin'])->prefix('fotokonkurs')->group(function () {
    Route::get('/fotokonkurs_add/{konkurs}', [\App\Http\Controllers\FotokonkursController::class, 'fotokonkurs_add'])->name('fotokonkurs_add');
    Route::post('/creat_uchastnik', [\App\Http\Controllers\FotokonkursController::class, 'creat_uchastnik'])->name('creat_uchastnik');
    Route::post('/set-voice', [\App\Http\Controllers\FotokonkursController::class, 'SetVoice'])->name('SetVoice');


});

Route::middleware(['role:user|admin'])->prefix('ozelenenie')->group(function () {

    Route::get('/new-ozelenenie', [\App\Http\Controllers\GreenController::class, 'creat_green'])->name('creat_green');
    Route::post('/store-green', [\App\Http\Controllers\GreenController::class, 'store_green'])->name('store_green');
    Route::post('/save-voice', [\App\Http\Controllers\GreenController::class, 'save_voice'])->name('save_voice');



});


Route::middleware(['role:user|admin'])->group(function () {
    Route::post('/set-like', [\App\Http\Controllers\LikeController::class, 'SetLike'])->name('SetLike');
    Route::post('/unset-like', [\App\Http\Controllers\LikeController::class, 'UnsetLike'])->name('UnSetLike');


});

Route::prefix('fotokonkursu')->group(function () {

    Route::get('/',[\App\Http\Controllers\FotokonkursController::class,'index'])->name('AllFotokonkurs');
    Route::get('/{konkurs}',[\App\Http\Controllers\FotokonkursController::class,'list_uchastniki'])->name('LinkKonkurs');
    Route::get('/{konkurs}/{uchastnik}',[\App\Http\Controllers\FotokonkursController::class,'uchastnik_open'])->name('LinkUchastnik');

});

Route::prefix('ozelenenie')->group(function () {

    Route::get('/',[\App\Http\Controllers\GreenController::class,'index'])->name('indexGreen');


});



Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {


    Route::get('/', [Admin\HomeController::class, 'index'])->name('homeAdmin'); // /admin


    Route::resource('users',Admin\UserController::class);
    Route::resource('rubric', Admin\RubricsController::class);
    Route::resource('novost', Admin\NovostsController::class);
    Route::resource('inforubric', Admin\InfoRubricsController::class);
    Route::resource('info', Admin\InfoController::class);
    Route::resource('odinvopros',Admin\OdinvoprosController::class);
    Route::resource('page',Admin\PageController::class);
    Route::resource('ludi',Admin\LudiController::class);
    Route::resource('moy-biznes',Admin\MoyBiznesController::class);
    Route::resource('categorii-biznesa',Admin\CategoryBiznesController::class);
    Route::resource('fotokonkurs',Admin\FotokonkursController::class);
    Route::resource('uchastniki-fotokonkursov',Admin\FotoKonkursMaterialController::class);
    Route::resource('moy-dvor',Admin\DvorController::class);
    Route::resource('oprosu',Admin\OprosController::class);
    Route::resource('groupu-oprosov',Admin\GroupOprosController::class);
    Route::resource('ozelenenie',Admin\GreenCotroller::class);
    Route::resource('categorii-ozelenenia',Admin\GreenCategoryCotroller::class);

    Route::get('baners',[Admin\BanerController::class,'index'])->name('AllBaners');
    Route::resource('baner',Admin\BanerController::class);


//    Route::get('baners/create',[Admin\BanerController::class,'create'])->name('baner.create');
//    Route::get('baners/',[Admin\BanerController::class,'store'])->name('baner.store');
//    Route::get('baners/{baner}/edit',[Admin\BanerController::class,'edit'])->name('baner.edit');
//    Route::put('baners/{baner}',[Admin\BanerController::class,'update'])->name('baner.update');
    Route::post('oprosu/del/', [Admin\OprosController::class, 'del_vopros'])->name('del_vopros');
    Route::post('ozelenenie/del/', [Admin\GreenCotroller::class, 'del_poligon'])->name('del_poligon');
    Route::post('users/mass-delete/', [Admin\UserController::class, 'del_users'])->name('del_users');



    //кабинет админа

});



Route::prefix('novosti')->group(function () {

    Route::get('/',[\App\Http\Controllers\NewsController::class,'index'])->name('AllNews');
    Route::get('/{rubric}',[\App\Http\Controllers\NewsController::class,'rubrica'])->name('LinkRubricNews');
    Route::get('/{rubric}/{novost}',[\App\Http\Controllers\NewsController::class,'new_open'])->name('LinkNew');

});

Route::prefix('info')->group(function () {

    Route::get('/',[\App\Http\Controllers\InfoController::class,'index'])->name('info');

});

Route::prefix('moy-biznes')->group(function () {

    Route::get('/',[\App\Http\Controllers\MoyBiznessController::class,'index'])->name('AllBiznes');
    Route::get('/{category}',[\App\Http\Controllers\MoyBiznessController::class,'сategory'])->name('LinkCategoryBiznes');
    Route::get('/{category}/{post}',[\App\Http\Controllers\MoyBiznessController::class,'post_open'])->name('LinkBiznes');

});

Route::prefix('moy-dvor')->group(function () {

    Route::get('/',[\App\Http\Controllers\DvorController::class,'index'])->name('AllDvors');
    Route::get('/{material}',[\App\Http\Controllers\DvorController::class,'material'])->name('LinkDvor');

});

Route::prefix('odin-vopros')->group(function () {

    Route::get('/',[\App\Http\Controllers\OdinvoprosController::class,'index'])->name('AllMaterial');
    Route::get('/{material}',[\App\Http\Controllers\OdinvoprosController::class,'material'])->name('LinkMaterial');

});

Route::prefix('moya-istoria')->group(function () {

    Route::get('/',[\App\Http\Controllers\LudiController::class,'index'])->name('AllLudi');
    Route::get('/{material}',[\App\Http\Controllers\LudiController::class,'material'])->name('LinkLudi');

});

Route::prefix('oprosu')->group(function () {

    Route::get('/',[\App\Http\Controllers\OprosController::class,'index'])->name('AllOpros');
    Route::get('/{opros}',[\App\Http\Controllers\OprosController::class,'opros'])->name('LinkOpros');
});

Route::get('/{page}', [\App\Http\Controllers\PageController::class, 'index'])->name('show_page');






Route::post('/upload_imаge',[\App\Http\Controllers\ImageloadController::class,'upload'])->name('upload_imаge');

Route::get('/file', function () {

    $img = Image::make('https://cs12.pikabu.ru/post_img/big/2019/11/22/9/157443446919832145.jpg');

    $img->resize(819,NULL, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });

    $height = $img->height();

    if ($height>546)
    {
        $img->crop(819, 546, 0, 400);
    }
    else
    {
        $img->crop(819, 546, 400, 0);
    }


    //  dd($img->width().' '.$img->height());
    return $img->response('jpg');
    //  return view('welcome');
});

