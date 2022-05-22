<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Odinvopros extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function like()
    {
        $data  =  $this->morphMany(Liked::class, 'likedable')->where('user_id','=',isset(Auth::user()->id) ?Auth::user()->id:0);

        return $data;

    }

    public function visit()
    {

        $data  =  $this->morphMany(Visit::class, 'visitable');

        return $data;

    }
}
