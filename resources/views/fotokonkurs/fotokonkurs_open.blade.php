@extends('layouts.app_face')

@section('title',$konkurs->title)
@section('description',$konkurs->description)

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / <a href="{{route('AllFotokonkurs')}}">Фотококурсы
                    моего округа</a> / {{$konkurs->h1}}</div>
            <h1>{{$konkurs->h1}} @if($konkurs->stop)(Конкурс завершен)@endif</h1>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="about-box">
                <div class="about-box__wrap">
                    {!! $konkurs->text !!}
                </div>
                <div>
                    <span class="about-box__more" data-toggle-text="Скрыть">Читать целиком</span>
                </div>
            </div>

           @if(!$konkurs->stop)
            <div class="photo_add"><a href="{{route('fotokonkurs_add',[$konkurs->id])}}"><img
                        src="{{asset('public/storage/fotokonkurs_image/'.$konkurs->baner)}}" border="0" alt=""/></a>
            </div>
            @endif
            <div class="photo_list">
                @if(count($uchasthiki))
                    @foreach($uchasthiki as $uchasthik)



                        <div class="item @if($uchasthik->winer) winner @endif">

                            <div class="likes"><span>{{$uchasthik->likes}}</span></div>
                            <figure><a href="{{route('LinkUchastnik',[$uchasthik->konkurs['alias'],$uchasthik->alias])}}"><img src="{{asset('public/storage/fotokonkurs_image/tumb/tumb-'.$uchasthik->img)}}"/></a></figure>
                            <div class="title"><a href="{{route('LinkUchastnik',[$uchasthik->konkurs['alias'],$uchasthik->alias])}}">{{$uchasthik->h1}}</a></div>
                            <div class="name">{{$uchasthik->fio}}</div>
                            @if(!$konkurs->stop)
                            @if (isset(Auth::user()->email_verified_at) && Auth::user()->email_verified_at!==NULL)

                            <button type="button" class="like" data-id="{{$uchasthik->id}}">
                                @if(count($uchasthik->voice))Вы проголосовали!@elseПРОГОЛОСОВАТЬ!@endif</button>
                            @else
                                <span><a href="{{route('register')}}">Зарегистрируйтесь<br /> для голосования !</a></span>
                            @endif
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>У конкурса пока нет участников</p>
                @endif


            </div>


            <div id="mc-container"></div>
            <script type="text/javascript">
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({
                    widget: 'Comment',
                    id: 78303,
                    ssoAuth: "{{session('auth_cackle.user_data')}} {{session('auth_cackle.sign')}} {{session('auth_cackle.timestamp')}}",
                    msg: {
                    social: 'Авторизируйтесь для комментирования !',
                }
                    /*
                    ssoProvider: {
                        name: 'Войдите через МойОкруг.рф',
                        url: '{{route('login')}}',
                        logo: '{{ asset("public/images/logo.svg")}}',
                        width: 64,
                        height: 64
                    } */
                });
                (function () {
                    var mc = document.createElement('script');
                    mc.type = 'text/javascript';
                    mc.async = true;
                    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(mc, s.nextSibling);
                })();
            </script>
            <a id="mc-link" href="https://cackle.me">Комментарии для сайта <b style="color:#4FA3DA">Cackl</b><b
                    style="color:#F65077">e</b></a>

            <script>
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({widget: 'CommentCount', id: 78303, no: ' ', one: ' ', mult: ' ', html: '<span class="count-comment{num}">Комментарии {num}</span>'});
                (function() {
                    var mc = document.createElement('script');
                    mc.type = 'text/javascript';
                    mc.async = true;
                    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                })();
            </script>

        </div>

        @include('layouts.right_block')
    </div>

@endsection
