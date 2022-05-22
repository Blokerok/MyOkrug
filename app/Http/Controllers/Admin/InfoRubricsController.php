<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoRubric;
use Illuminate\Http\Request;
use Transliterate;

class InfoRubricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = InfoRubric::orderBy('created_at', 'asc')->get();

        return view('admin.inforubric.index', [
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
        return view('admin.inforubric.create');
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

        $new_category = new InfoRubric();
        $new_category->title = $request->title;

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
     * @param \App\Models\InfoRubric $rubric
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoRubric $inforubric)
    {

        return view('admin.inforubric.edit', [
            'category' => $inforubric
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\InfoRubric $rubric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfoRubric $inforubric)
    {

        $inforubric->title = $request->title;

        $inforubric->save();

        return redirect(route('inforubric.index'))->with(['success' => 'Рубрика была успешно обновлена!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoRubric $inforubric)
    {
        if($inforubric->info())
            return redirect(route('inforubric.index'))->with(['error' => 'Рубрика содержит организации']);

        $inforubric->delete();
        return redirect()->back()->withSuccess('Рубрика была успешно удалена!');
    }
}
