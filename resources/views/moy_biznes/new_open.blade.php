@extends('layouts.app_face')

@section('title',$novost->title)
@section('description',$novost->description)

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / <a href="{{route('AllBiznes')}}">"Мой бизнес"</a> /
                <a href="{{route('LinkCategoryBiznes',[$novost->category['alias']])}}">{{$novost->category->title}}</a>
                / {{$novost->h1}}</div>
            <h1>{{$novost->h1}}</h1>

            <div class="inits-card__descr">
                <figure class="img_news_1"><a href="{{asset('public/storage/moy_okrug_image/'.$novost->img)}}"
                                              class="fb"><img width="279"
                                                              src="@if($novost->img) {{asset('public/storage/moy_okrug_image/tumb/tumb-'.$novost->img)}} @else {{asset('public/uploads/news-03.jpg')}} @endif"/></a>
                </figure>

                {!! $novost->text !!}


            </div>
            <div class="clear"></div>

            @if(count($novost->images))
                <div class="gallery">
                    @foreach ($novost->images as $img)
                        <div class="item"><a data-fancybox="gallery"
                                             href="{{asset('public/storage/moy_okrug_image/'.$img->img)}}" class="fb"><img
                                    width="279" src="{{asset('public/storage/moy_okrug_image/tumb/tumb-'.$img->img)}}"/></a></div>
                    @endforeach
                </div>
            @endif

            <div class="inits-card__bottom-stat">
                <div class="objs-stat">
                    <div class="objs-stat__item">{{ $novost->visits }} просмотров</div>
                    <div class="objs-stat__item"><span class=" @if(count($novost->like))unmark_liked ico_liked @else mark_liked ico_like @endif" data-id="{{$novost->id}}" data-model="MoyBiznes"> {{$novost->likes}} отметок «Нравится»</span></div>
                    <div class="objs-stat__item cackle-comment-count" data-cackle-channel="/moy-biznes/{{$novost->category['alias']}}/{{$novost['alias']}}"></div>
                    <div class="objs-stat__item">Автор: {{$novost->user['login']}}</div>
                </div>
            </div>

            <p class="back"><a href="{{route('AllBiznes')}}">Вернуться к списку материалов</a></p>


            <h2>Другие материалы категории "{{$rubrica->title}}"</h2>

            <div class="section-outer">
                <div class="row">
                    @if(count($other_news))
                        @foreach($other_news as $new)

                            <div class="col-md-4">
                                <a href="{{route('LinkBiznes',[$new->category['alias'],$new->alias])}}" class="news-card">
                                    <figure class="news-card__thumb"><img
                                            src="@if($new->img) {{asset('public/storage/moy_okrug_image/'.$new->img)}} @else {{asset('public/uploads/news-03.jpg')}} @endif"
                                            alt=""/></figure>
                                    <div class="news-card__info">
                                        <div class="news-card__info-part"
                                             style="color:{{$new->category['color']}};">{{$new->category->h1}}</div>
                                        <div
                                            class="news-card__info-date">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                    </div>
                                    <div class="news-card__title">
                                        {{$new->h1}}
                                    </div>
                                </a>
                            </div>

                        @endforeach
                    @else
                        <p class="nonews">Других новостей в рубрике пока нет</p>
                    @endif

                </div>
            </div>

            <div id="mc-container"></div>
            <script type="text/javascript">
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
