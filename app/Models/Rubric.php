<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;

    public function news() {

        return  $this->hasMany(Novost::class,'rubric_id','id')->where('public','=',1)->orderByDesc('created_at');
    }


}
