<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Liked;
use App\Models\Novost;
use App\Models\Opros;
use App\Models\User;
use App\Models\Voices_opros;
use App\Models\Vopros;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       // $user->delete();

        return redirect()->back()->withSuccess('Пользователи были успешно удалены !');
    }

    public function del_users(Request $request)
    {


        if ($request->delete!==NULL) {
           
            User::query()->whereIn('id', $request->delete)->delete();
            Voices_opros::query()->whereIn('user_id', $request->delete)->delete();
            Liked::query()->whereIn('user_id', $request->delete)->delete();
        }

         $oproses = Opros::all();



         foreach ($oproses as $opros)
         {
             $voproses = $opros->voproses;

             foreach ($voproses as $vopros_)
             {
                 $voises = Voices_opros::query()->where('vopros_id','=',$vopros_->id)->count();

                 $vopros = Vopros::query()->where('id','=',$vopros_->id)->first();

                 $vopros->voices=$voises;
                 $vopros->save();

             //    var_dump($voises);


             }




         }

         //dd('');

        return redirect()->back()->withSuccess('Пользователи были успешно удалены !');
    }


}
