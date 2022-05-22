<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CategoryGreen;
use App\Models\OzeleneniePoligon;
use App\Models\Vopros;
use Illuminate\Http\Request;

class GreenCategoryCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $categories = CategoryGreen::orderBy('created_at', 'desc')->get();

        return view('admin.category_green.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category_green.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_category = new CategoryGreen();
        $new_category->title = $request->title;
        $new_category->color = $request->color;
        $new_category->save();

        return redirect()->back()->withSuccess('Категория была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryGreen $categorii_ozelenenium)
    {
        return view('admin.category_green.edit', [
            'category' => $categorii_ozelenenium
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryGreen $categorii_ozelenenium)
    {
        $categorii_ozelenenium->title = $request->title;
        $categorii_ozelenenium->color = $request->color;
        $categorii_ozelenenium->save();

        return redirect()->route('categorii-ozelenenia.index')->withSuccess('Категория была успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryGreen $categorii_ozelenenium)
    {
        $categorii_ozelenenium->delete();
        return redirect()->back()->withSuccess('Категория была успешно удалена!');
    }


}
