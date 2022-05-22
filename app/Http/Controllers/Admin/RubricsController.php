<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Transliterate;

class RubricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Rubric:: orderBy('created_at', 'desc')->get();

        return view('admin.rubric.index', [
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
        return view('admin.rubric.create');
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

        $new_category = new Rubric();
        $new_category->title = $request->title;
        $new_category->description = $request->title;
        $new_category->h1 = $request->title;
        $new_category->alias = Transliterate::slugify($request->title);

        $result = Rubric::query()->where('alias', '=', $new_category->alias)->first();

        if (isset($result->id) && $result->id)
            return redirect()->back()->with(['error' => 'Такая рубрика уже есть!','old'=>$new_category]);
        $new_category->save();

        return redirect()->back()->withSuccess('Рубрика была успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubric $rubric)
    {
        return view('admin.rubric.edit', [
            'category' => $rubric
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubric $rubric)
    {
        $result = Rubric::query()->where('alias', '=', $request->alias)->first();
        if (isset($result->id) && $result->id && $rubric->alias != $request->alias)
            return redirect()->back()->with(['error' => 'Такая рубрика c алиасом ' . $request->alias . ' уже есть!']);

        $rubric->title = $request->title;
        $rubric->description = $request->description;
        $rubric->h1 = $request->h1;
        $rubric->alias = $request->alias;
        $rubric->color = $request->color;

        $rubric->save();

        return redirect(route('rubric.index'))->with(['success' => 'Рубрика была успешно обновлена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubric $rubric)
    {
        $rubric->delete();
        return redirect()->back()->withSuccess('Рубрика была успешно удалена!');
    }
}
