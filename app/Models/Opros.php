<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opros extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(GroupOpros::class, 'group_id', 'id');

    }

    public function voproses() {

        return  $this->hasMany(Vopros::class,'opros_id','id')->whereNull('self_answer')->orderBy('voices','DESC');
    }

    public function voproses_face() {

        return  $this->hasMany(Vopros::class,'opros_id','id')->orderBy('voices','DESC');
    }

    public function voproses_muself() {

        return  $this->hasMany(SelfAnswer::class,'opros_id','id');
    }
}
