<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoRubric extends Model
{
    use HasFactory;

    public function info() {

        return  $this->hasMany(Info::class,'rubric_id','id')->where('public','=',1)->orderByDesc('created_at');
    }


}
