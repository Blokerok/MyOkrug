<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotokonkurs extends Model
{
    use HasFactory;

    public function uchastniki() {

        return  $this->hasMany(FotoKonkursMaterial::class,'konkurs_id','id')->orderByDesc('created_at');
    }

    public function uchastniki_stop() {

        return  $this->hasMany(FotoKonkursMaterial::class,'konkurs_id','id')->orderByDesc('likes');
    }
}
