<?php

namespace App\Models;

use App\Http\Controllers\Admin\GreenCategoryCotroller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ozelenenie extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(CategoryGreen::class, 'category_id', 'id');

    }

    public function present_voice()
    {
        $voice = $this->hasMany(GreenVoice::class, 'id_green', 'id')->where('user_id','=',Auth::check() && Auth::user()->id ? Auth::user()->id:0 )->count();

        return  $voice;

    }

    public function count_yes()
    {

        $voice = $this->hasMany(GreenVoice::class, 'id_green', 'id')->where('yes','=',1)->count();

        return  $voice;

    }

    public function count_no()
    {
        $voice = $this->hasMany(GreenVoice::class, 'id_green', 'id')->where('no','=',1)->count();

        return  $voice;

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function poligons() {

        return  $this->hasMany(OzeleneniePoligon::class,'id_green','id');
    }
}
