<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vopros extends Model
{
    use HasFactory;

    public function voices_() {

               return  $this->hasMany(Voices_opros::class,'vopros_id','id');
    }
}
