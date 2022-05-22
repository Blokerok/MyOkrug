<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rubric;

class CategoryTestController extends Controller
{
    public function show_rubric($rubric)
    {
      $rubrica = Rubric::query()->where('alias','=',$rubric)->get();
      dd($rubrica);

    }
}
