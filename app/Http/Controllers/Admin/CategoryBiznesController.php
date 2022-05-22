<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryBiznes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Transliterate;

class CategoryBiznesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryBiznes::orderBy('created_at', 'desc')->get();

        return view('admin.biznes_category.index', [
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
        return view('admin.biznes_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(['alias']=> ['required', max:255', 'unique:users']);

        $new_category = new CategoryBiznes();
        $new_category->title = $request->title;
        $new_category->description = $request->title;
        $new_category->h1 = $request->title;
        $new_category->alias = Transliterate::slugify($request->title);

        $result = CategoryBiznes::query()->where('alias', '=', $new_category->alias)->first();

        if (isset($result->id) && $result->id)
            return redirect()->back()->with(['error' => 'Такая категория уже есть!','old'=>$new_category]);
        $new_category->save();

        return redirect(route('categorii-biznesa.index'))->with(['success' => 'Категория была успешно добавлена!']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryBiznes $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryBiznes $categorii_biznesa)
    {
        return view('admin.biznes_category.edit', [
            'category' => $categorii_biznesa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryBiznes $categorii_biznesa)
    {
        $rubric = $categorii_biznesa;
        $result = CategoryBiznes::query()->where('alias', '=', $request->alias)->first();
        if (isset($result->id) && $result->id && $rubric->alias != $request->alias)
            return redirect()->back()->with(['error' => 'Такая категория c алиасом ' . $request->alias . ' уже есть!']);

        $rubric->title = $request->title;
        $rubric->description = $request->description;
        $rubric->h1 = $request->h1;
        $rubric->alias = $request->alias;
        $rubric->color = $request->color;

        $rubric->save();

        return redirect(route('categorii-biznesa.index'))->with(['success' => 'Категория была успешно обновлена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryBiznes $categorii_biznesa)
    {
        $categorii_biznesa->delete();
        return redirect()->back()->withSuccess('Категория была успешно удалена!');
    }
}
