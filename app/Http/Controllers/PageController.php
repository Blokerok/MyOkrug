<?php

namespace App\Http\Controllers;

use App\Models\Glava;
use App\Models\Novost;
use App\Models\Opros;
use App\Models\Page;
use App\Models\SelfAnswer;
use App\Models\Voices_opros;
use App\Models\Vopros;
use App\Notifications\SendToGlava;
use App\UserLib\AuthCackle;
use App\UserLib\CkeckUserIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PageController extends Controller
{
    public function index($page)
    {
        $page = Page::query()->where('alias', '=', $page)->first();
        if ($page === NULL) abort('404');

        AuthCackle::login_cackle();
        CkeckUserIP::RegVisit('App\Models\Page', $page);
        session()->put('user_url',URL::current());

        $oprosu = [];
        $iam_voises = [];
        $statistik_opros = [];

        if ($page->id == 14) {

            $oprosu = Opros::query()->get();

            foreach ($oprosu as $opros) {
                $iam_voises[$opros->id] = 0;
                // dump($opros->voproses);
                foreach ($opros->voproses as $vopros) {
                    if ($iam_voises[$opros->id] == 1) break;

                    if (count($vopros->voices_)) {
                        foreach ($vopros->voices_ as $voice)
                            if (Auth::check() && Auth::user()->id == $voice->user_id) {
                                $iam_voises[$opros->id] = 1;
                                break;
                            }
                    }
                }

            }

            foreach ($oprosu as $opros) {

                $total_voises = Vopros::query()->where('opros_id', '=', $opros->id)->sum('voices');
                $statistik_opros[$opros->id]['total'] = $total_voises;
                $voproses = $opros->voproses;
                foreach ($voproses as $vopros) {

                    $statistik_opros[$opros->id][$vopros->id]['persent'] = (int)($vopros->voices ? $vopros->voices / $total_voises * 100 : 0);


                }

            }

        }

        return view('page', ['page' => $page, 'oprosu' => $oprosu, 'iam_voises' => $iam_voises, 'statistik_opros' => $statistik_opros]);
    }

    public function mailToGlava(Request $request, Glava $glava)
    {

        $this->validate($request,
            ['file' => 'mimes:jpeg,jpg,png,pdf,doc,xls,docx,xlsx,txt,zip,rar|max:4096',
                'phone' => ['required', 'string'],
                'tema' => ['required', 'string'],
                'text' => ['required', 'string'],
            ]);

        //  dd($request->file('file')->getClientMimeType());

        if ($request->file('file') != NULL) {
            $name = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->extension();

            $image = $request->file('file');
            if ($request->hasFile('file')) {
                $request->file('file')->move(storage_path('public/file_forms/'), $name . '.' . $extension);
            }

            $request->attach = storage_path('public/file_forms/' . $name . '.' . $extension);
        }
        //  dd($request);
        $glava->notify(new SendToGlava($request));


        return back()->with('messege', 'Спасибо за обращение! Ваше сообщение успешно отправлено Главе округа!');

    }

    public function save_voice(Request $request)
     {
        if ($request->vopros) {


            $voice = new Voices_opros();

            $voice->vopros_id = $request->vopros;

            $voice->user_id = Auth::user()->id;
            $voice->save();

            if ($request->selfanswer && $request->selfanswer_text)
            {
                $selfAnswer = new SelfAnswer();
                $selfAnswer->answer = $request->selfanswer_text;
                $selfAnswer->opros_id = $request->opros;
                $selfAnswer->user_id = Auth::user()->id;
                $selfAnswer->save();

            }

            Vopros::query()->where('id', '=', $request->vopros)->increment('voices');
            $opros = Opros::query()->where('id', '=', $request->opros)->first();
            $statistik_opros = [];
            $total_voises = Vopros::query()->where('opros_id', '=', $request->opros)->sum('voices');
            $statistik_opros['total'] = $total_voises;
            foreach ($opros->voproses_face as $vopros) {
                $statistik_opros[$vopros->id]['persent'] = (int)($vopros->voices ? $vopros->voices / $total_voises * 100 : 0);
            }
            foreach ($opros->voproses_face as $vopros) {echo '<div class="item">
                                <div class="neme">' . $vopros->vopros . '</div>
                                <div class="procent">
                                    <div class="procent_data">' . $statistik_opros[$vopros->id]['persent'] . '% (' . $vopros->voices . ')</div>
                                    <div class="procent_line" style="width:' . $statistik_opros[$vopros->id]['persent'] . '%"></div>
                                </div>
                            </div>';
            }

            echo '<p><strong>Спасибо за Ваш голос.</strong></p><p>Всего проголосовало: <strong>' . $statistik_opros['total'] . '</strong> чел.</p>';
        }
    }

}
