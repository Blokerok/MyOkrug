@extends('layouts.app_face')

@section('title',$group->title)
@section('description',$group->description)

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / <a href="{{url('oprosu')}}">Опросы</a> / {{$group->title}}</div>
            <h1>{{$group->h1}}</h1>



            <div class="inits-card__descr">
                @if($group->img)
                    <figure><img
                                src="{{asset('public/storage/page_image/'.$group->img)}}"/>
                    </figure>
                @endif

                    {!!$group->text_page!!}

                    @include('oprosu')


            </div>
            <div class="clear"></div>





            <p class="back"><a href="{{url('oprosu')}}">Вернуться назад</a></p>

            <div id="mc-container"></div>
            <script>
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({widget: 'Comment', id: 78303,ssoAuth: "{{session('auth_cackle.user_data')}} {{session('auth_cackle.sign')}} {{session('auth_cackle.timestamp')}}",
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
                    } */ });
                (function() {
                    var mc = document.createElement('script');
                    mc.type = 'text/javascript';
                    mc.async = true;
                    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                })();
            </script>
            <a id="mc-link" href="https://cackle.me">Комментарии для сайта <b style="color:#4FA3DA">Cackl</b><b style="color:#F65077">e</b></a>
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
