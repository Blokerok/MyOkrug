@extends('layouts.app_face')

@section('title')
    Репортажи раздела "Один вопрос"
@endsection

@section('description')
    Репортажи раздела "Один вопрос"
@endsection

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / Репортажи раздела "Один вопрос"</div>

            <h1>Репортажи раздела "Один вопрос"</h1>

            <div class="inits-list">

                @if(count($materials))
                    @foreach ($materials as $mat)

                        <div class="inits-list__item">
                            <div class="inits-card">
                                <div class="inits-card__wrap">
                                    <div class="inits-card__thumb_v">
                                        <a href="{{$mat->link_youtube}}" data-fancybox class="fb">
                                            <span>&#9656;</span>
                                            <img
                                                src="@if($mat->img){{asset('public/storage/odinvopros_image/tumb/tumb-'.$mat->img)}}@else{{asset('public/uploads/news-03.jpg')}}@endif"
                                                alt=""/>
                                        </a>
                                    </div>
                                    <div class="inits-card__info">
                                        <div class="inits-card__title"><a
                                                href="{{route('LinkMaterial',$mat->alias)}}">{{$mat->h1}}</a></div>
                                        <div class="inits-card__descr">
                                           {{Str::of(strip_tags($mat->text))->words(20, ' ...')}}
                                        </div>
                                        <div class="inits-card__bottom">
                                            <!--div class="inits-card__bottom-vote">
                                                <div class="objs-vote">
                                                    <a href="#" class="objs-vote__button objs-vote__button--like"><span></span> За</a>
                                                    <a href="#" class="objs-vote__button objs-vote__button--dislike"><span>0</span> Против</a>
                                                </div>
                                            </div-->
                                            <div class="inits-card__bottom-stat">
                                                <div class="objs-stat">
                                                    <div class="objs-stat__item">{{$mat->visits}} просмотров</div>
                                                    <div class="objs-stat__item cackle-comment-count" data-cackle-channel="/odin-vopros/{{$mat->alias}}"></div>
                                                    <div class="objs-stat__item">Автор: {{$mat->user['login']}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>На портале пока нет материалов.</p>
                @endif

            </div>

        </div>


        @include('layouts.right_block')
    </div>

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

@endsection
