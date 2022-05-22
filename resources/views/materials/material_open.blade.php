@extends('layouts.app_face')

@section('title',$material->title)
@section('description',$material->description)

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / <a href="{{route('AllMaterial')}}">Один вопрос</a>  / {{$material->h1}}</div>
            <h1>{{$material->h1}}</h1>

            <div class="inits-card__descr">
                <figure class="img_news_1"><a href="{{asset('public/storage/odinvopros_image/'.$material->img)}}" class="fb"><img src="@if($material->img) {{asset('public/storage/odinvopros_image/tumb/tumb-'.$material->img)}} @else {{asset('public/uploads/news-03.jpg')}} @endif"/></a></figure>

                    {!! $material->text !!}

                <iframe width="100%" height="600"  src="{{$material->link_youtube}}" frameborder="0" autoplay="1" allowfullscreen></iframe>



            </div>
						<div class="clear"></div>
            <div class="inits-card__bottom-stat">
                <div class="objs-stat">
                    <div class="objs-stat__item">{{ $material->visits }} просмотров</div>
                    <div class="objs-stat__item"><span class=" @if(count($material->like))unmark_liked ico_liked @else mark_liked ico_like @endif" data-id="{{$material->id}}" data-model="Odinvopros"> {{$material->likes}} отметок «Нравится»</span></div>
                    <div class="objs-stat__item cackle-comment-count" data-cackle-channel="/odin-vopros/{{$material['alias']}}"></div>
                    <div class="objs-stat__item">Автор: {{$material->user['login']}}</div>
                </div>
            </div>


						<p class="back"><a href="{{route('AllMaterial')}}">Вернуться к списку репортажей</a></p>


            <div id="mc-container"></div>
            <script type="text/javascript">
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({widget: 'Comment', id: 78303,
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
