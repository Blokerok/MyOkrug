<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBiznes extends Model
{
    use HasFactory;

    public function news() {

        return  $this->hasMany(MoyBiznes::class,'category_id','id')->orderByDesc('created_at');
    }
}
