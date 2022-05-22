<div class="polls_block">
    @if (count($oprosu))
        @foreach($oprosu as $opros)

            <div class="polls">
                <div class="wrap">

                    @if(Auth::check())
                        <form id="opros{{$opros->id}}" action="{{route('save_voice')}}" method="post"> @endif

                            <div class="polls_title">{{$opros->title}}</div>
                            <div class="polls_img"><img
                                    src="{{asset('public/storage/page_image/'.$opros->img)}}"></div>
                            <div id="polls{{$opros->id}}"
                                 @if (strtotime($opros->stop)<time() && $opros->stop!=NULL)class="popup_video"@endif>
                                <div class="polls_unit">

                                    @if( !$iam_voises[$opros->id])
                                        @foreach($opros->voproses_face as $vopros)
                                            <div class="item">
                                                <input data-opros="{{$opros->id}}" data-selfanswer="{{$vopros->self_answer}}" class="radio_opros" type="radio" name="vopros{{$opros->id}}"
                                                       value="{{$vopros->id}}">
                                                <label>{{$vopros->vopros}}</label>
                                            </div>
                                        @endforeach
                                        @if($opros->self_answer)

                                                <textarea rows="5" cols="50" class="self_answer{{$opros->id}}" style="display:none" name="self_answer{{$opros->id}}"></textarea>

                                        @endif
                                    @endif
                                </div>

                                @if(strtotime($opros->stop)>time() && $opros->stop!=NULL)
                                    @if(Auth::check() && !$iam_voises[$opros->id] && Auth::user()->email_verified_at!==NULL)
                                        <div class="result_button">
                                            <input type="button" class="go-voice" data-opros="{{$opros->id}}"
                                                   value="Голосовать">
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </form>



                        @if(strtotime($opros->stop)<time() && $opros->stop)

                            <div class="polls_result" id="result{{$opros->id}}">
                                @else
                                    <div class="polls_result @if(!$iam_voises[$opros->id]) popup_video @endif"
                                         id="result{{$opros->id}}">
                                        @endif


                                        @foreach($opros->voproses_face as $vopros)
                                            <div class="item">
                                                <div class="neme">{{$vopros->vopros}}</div>
                                                <div class="procent">
                                                    <div
                                                        class="procent_data">{{$statistik_opros[$opros->id][$vopros->id]['persent']}}
                                                        % ({{$vopros->voices}})
                                                    </div>
                                                    <div class="procent_line"
                                                         style="width:{{$statistik_opros[$opros->id][$vopros->id]['persent']}}%"></div>
                                                </div>
                                            </div>



                                        @endforeach

                                        <p>Всего проголосовало:
                                            <strong>{{$statistik_opros[$opros->id]['total']}}</strong>
                                            чел.</p>
                                    </div>

                                    @if(strtotime($opros->stop)<=time() && $opros->stop!=NULL)

                                        <strong>Голосование закончено</strong>
                                    @else
                                        @guest
                                            <p>Для голосования необходимо <a
                                                    href="{{route('login')}}">Авторизироваться</a></p>
                                        @endguest
                                    @endif


                            </div>
                </div>
                @endforeach
                @else
                    <p>Активных опросов на данный момент пока нет</p>
                @endif

            </div>
