<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Info extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(InfoRubric::class, 'rubric_id', 'id');

    }


}
