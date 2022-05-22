<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\District;
use App\Notifications\SendToAdmin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\UserLib\CreatImage;


class HomeController extends Controller
{
    public function index()
    {

        $districts = District::all()->sortBy('sort');
        return view('cabinet.home')->with(['districts' => $districts]);

    }


    public function mailToAdmin(Request $request, Admin $admin)
    {


        $this->validate($request,
            ['file' => 'mimes:jpeg,jpg,png,pdf,doc,xls,docx,xlsx,txt,zip,rar|max:4096',
                'tema' => ['required', 'string'],
                'text' => ['required', 'string'],
            ]);

        //  dd($request->file('file')->getClientMimeType());

        if ($request->file('file') != NULL)
        {
            $name = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->extension();

            $image = $request->file('file');
            if ($request->hasFile('file')) {
                $request->file('file')->move(storage_path('public/file_forms/'), $name . '.' . $extension);
            }

            $request->attach = storage_path('public/file_forms/' . $name . '.' . $extension);
        }
        //  dd($request);
        $admin->notify(new SendToAdmin($request));


        return back()->with('messege', 'Спасибо за обращение! Ваше сообщение успешно отправлено администратору портала!');

    }



    public function save_avatar(Request $request)
    {

        $this->validate($request,
            ['avatar' => ['required', 'mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:4096']]);
        if ($request->file('avatar') != NULL) {
            $img = Image::make($request->file('avatar'));


            $height = $img->getHeight();
            $width = $img->getWidth();

            if ($width < 220) {
                return redirect()->back()->with(['error_img' => 'Изображение по ширине меньше 220px, найдите изображение качественней !']);

            }
            if ($height < 280) {
                return redirect()->back()->with(['error_img' => 'Изображение по высоте меньше 280px, найдите изображение качественней !']);
            }

            $img = CreatImage::creat_img($img,220,280);

            $user = Auth::user();

            if (!is_dir(storage_path('app/public/avatars/' . $user->id))) mkdir(storage_path('app/public/avatars/' . $user->id, 0777));
            if (file_exists(storage_path('app/public/avatars/' . $user->id . '/' . $user->avatar)) && $user->avatar)
                unlink(storage_path('app/public/avatars/' . $user->id . '/' . $user->avatar));
            $file = 'avatar-' . time() . '.jpg';
            $img->save(storage_path('app/public/avatars/' . $user->id . '/' . $file));
            $data = ['avatar' => $file];
            $user->update($data);


            return back()->with('messege', 'Ваш аватар сохранен.');

        }

        return back();


    }

       public  function del_avatar()
       {
           $user = Auth::user();
           $data = ['avatar' => NULL];

           unlink(storage_path('app/public/avatars/' . $user->id . '/' . $user->avatar));
           $user->update($data);
           return back()->with('messege', 'Ваш аватар удален.');
       }

    public function update(Request $request)
    {
        $user = Auth::user();

        $valid_mass = [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'id_district' => ['required', 'string'],
            'date_b' => ['string', 'max:10'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'max:255', 'unique:users']];


        $date_mass = explode(".", $request->date_b);
        if ($request->login == $user->login) unset($valid_mass['login']);
        if ($request->email == $user->email) unset($valid_mass['email']);


        $data = $this->validate($request, $valid_mass);

        $data['date_b'] = $date_mass[2] . '-' . $date_mass[1] . '-' . $date_mass[0];
        //   dd($data);
        // dd($request->all());
        $user->update($data);

        return back()->with('messege', 'Ваши данные обновлены.');

    }
}
