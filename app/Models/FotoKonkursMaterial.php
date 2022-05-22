<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FotoKonkursMaterial extends Model {
    use HasFactory;

    public function konkurs() {
        return $this->belongsTo(Fotokonkurs::class, 'konkurs_id', 'id');

    }


    public function images() {

        return $this->hasMany(FotoKonkursImage::class, 'uchastnik_id', 'id');
    }


    public function voice() {
        $data = $this->morphMany(Liked::class, 'likedable')->where('user_id', '=', Auth::user()->id);

        return $data;

    }

    public function visit() {

        $data = $this->morphMany(Visit::class, 'visitable');

        return $data;

    }

    public static function getCategories() {
        return [
            "Экскурс во времени",
            "Стиль эпохи",
            "Семейная реликвия"
        ];
    }


}
