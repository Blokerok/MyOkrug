<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoyDvor extends Model
{
    use HasFactory;

    public function images() {

        return  $this->hasMany(DvorImage::class,'dvor_id','id');
    }
    public function visit()
    {

        $data  =  $this->morphMany(Visit::class, 'visitable');

        return $data;

    }
}
