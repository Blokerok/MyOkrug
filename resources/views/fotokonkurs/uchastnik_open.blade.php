@extends('layouts.app_face')

@section('title',$uchastnik->title)
@section('description',$uchastnik->description)

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / <a href="{{route('AllFotokonkurs')}}">Фотококурсы моего округа</a> /   <a href="{{route('LinkKonkurs',[$konkurs->alias])}}">{{$konkurs->h1}}</a> /  {{$uchastnik->h1}}</div>
            <h1>{{$uchastnik->h1}}</h1>


            <div class="photo_list">
                <div class="item">
                    <div class="likes"><span>{{$uchastnik->likes}}</span></div>
                    <figure><a href="{{asset('public/storage/fotokonkurs_image/'.$uchastnik->img)}}"  class="fb" data-fancybox="gallery"><img src="{{asset('public/storage/fotokonkurs_image/tumb/tumb-'.$uchastnik->img)}}" /></a></figure>
                    <div class="title"><a href="">{{$uchastnik->h1}}</a></div>
                    <div class="name">{{$uchastnik->fio}}</div>
                    @if (isset(Auth::user()->email_verified_at) && Auth::user()->email_verified_at!==NULL)
                        <button type="button" class="like" data-id="{{$uchastnik->id}}">
                            @if(count($uchastnik->voice))Вы проголосовали!@elseПРОГОЛОСОВАТЬ!@endif</button>
                    @else
                        <span><a href="{{route('register')}}">Зарегистрируйтесь<br /> для голосования !</a></span>
                    @endif
                </div>
                <div class="gal">
                @foreach($uchastnik->images as $img)
                    <a href="{{asset('public/storage/fotokonkurs_image/'.$img->img)}}" class="fb" data-fancybox="gallery"><img  src="{{asset('public/storage/fotokonkurs_image/tumb/tumb-'.$img->img)}}" alt=""></a>
                @endforeach

                </div>
            </div>

            {!! $uchastnik->text !!}

            <script src="https://yastatic.net/share2/share.js"></script>
            <div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"></div>

            <div class="back_url"><a href="{{route('LinkKonkurs',[$konkurs->alias])}}">Вернуться назад</a></div>


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

        </div>

        @include('layouts.right_block')
    </div>

@endsection
