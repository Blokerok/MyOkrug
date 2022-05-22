@extends('layouts.app_face')

@section('title')
Мой Округ - общественный портал Раменского городского округа
@endsection
@section('description','Главная страница')

@section('content')
        <div class="page-wrap">
            <div class="page-content">

                <div class="promo-box">

                    <div class="promo-slider js-promo-slider">

                            @foreach ($new_of_day as $new)
                            <div class="promo-slider__item">
                            <a href="{{route('LinkNew',[$new->category['alias'],$new->alias])}}" class="promo-slide" style="background-image: url({{asset('public/storage/news_image/'.$new->img)}});">
                                <div class="promo-slide__wrap">
                                    <div class="promo-slide__title">{{$new->h1}}</div>
                                    <div class="promo-slide__info">
                                        <div class="promo-slide__info-part promo-slide__info-part--blue">Новость дня</div>
                                        <div class="promo-slide__info-date">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                    </div>
                                </div>
                            </a>
                            </div>   @endforeach


                    </div>

                </div>

                <div class="section-outer">
                    <div class="row">
                        <div class="col-md-8">
                            <a href="{{route('LinkNew',[$new_last->category['alias'],$new_last->alias])}}" class="news-card news-card--lg">
                                <figure class="news-card__thumb" style="background-image: url( @if($new_last->img) {{asset('public/storage/news_image/'.$new_last->img)}}@else./public/uploads/news-03.jpg @endif);"><img src="@if($new_last->img) {{asset('public/storage/news_image/'.$new_last->img)}} @else ./public/uploads/news-03.jpg @endif" alt="" /></figure>

                                <div class="news-card__wrap">
                                    <div class="news-card__info" style="color:{{$new_last->category['color']}};">
                                        <div class="news-card__info-part">{{$new_last->category->h1}}</div>
                                        <div class="news-card__info-date">{{date('d.m.Y H:i', strtotime($new_last->created_at))}}</div>
                                    </div>
                                    <div class="news-card__title">
                                        {{$new_last->h1}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">

                            @if(count($news_last))
                                @foreach ($news_last as $new)

                            <div class="news-feed">
                                <div class="news-feed__item">
                                    <a href="#" class="news-card news-card--orange">
                                        <div class="news-card__info" style="color:{{$new->category['color']}};">
                                            <div class="news-card__info-part"><a href="{{route('LinkRubricNews',[$new->category['alias']])}}">{{$new->category->h1}}</a></div>
                                            <div class="news-card__info-date">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                        </div>
                                        <div class="news-card__title">
                                            <a href="{{route('LinkNew',[$new->category['alias'],$new->alias])}}">{{$new->h1}}</a>

                                        </div>
                                    </a>
                                </div>
                            </div>
                                @endforeach
                            @else
                                <p>На портале пока нет новостей.</p>
                            @endif

                            <div class="news-feed__more">
                                <a href="{{ route('AllNews') }}">Все новости</a>
                            </div>
                        </div>
                    </div>
                </div>


               @if ($baner1->status)
                <div class="banan">
                    <a href="{{$baner1->url}}"><img src="{{asset('public/storage/baners/'.$baner1->baner)}}" alt="" /></a>
                </div>
                @endif

                <section class="content-box content-box--orange">
                    <h2 class="content-box__title">Свежие публикации раздела Один Вопрос</h2>

                    <div class="row">
                        @if(count($materials))
                            @foreach ($materials as $new)
                        <div class="col-md-4">
                            <a href="{{route('LinkMaterial',$new->alias)}}" class="news-card news-card--orange">
                                <figure class="news-card__thumb"><img src="@if($new->img) {{asset('public/storage/odinvopros_image/tumb/tumb-'.$new->img)}} @else ./public/uploads/news-03.jpg @endif" alt="" /></figure>
                                <div class="news-card__info">
                                    <div class="news-card__info-date">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                </div>
                                <div class="news-card__title">
                                    {{$new->h1}}
                                </div>
                            </a>
                        </div>
                            @endforeach
                        @else
                            <p>На портале пока нет публикаций в этом разделе.</p>
                        @endif

                    </div>
                </section>

                <section class="content-box content-box--blue-dark">
                    <h2 class="content-box__title">Свежие публикации раздела Мой Округ</h2>

                    <div class="row">
                        @if(count($moy_okrug))
                            @foreach ($moy_okrug as $new)
                                <div class="col-md-4">
                                    <a href="@if($new->type=='ludi'){{route('LinkLudi',[$new->alias])}}@elseif($new->type=='biznes'){{route('LinkBiznes',[$new->category_alias,$new->alias])}}@endif" class="news-card news-card--orange">
                                        <figure class="news-card__thumb"><img src="@if($new->img) {{asset('public/storage/moy_okrug_image/tumb/tumb-'.$new->img)}} @else ./public/uploads/news-03.jpg @endif" alt="" /></figure>
                                        <div class="news-card__info">
                                            <div class="news-card__info-date">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                        </div>
                                        <div class="news-card__title">
                                            {{$new->h1}}
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>На портале пока нет публикаций в этом разделе.</p>
                        @endif

                        </div>

                </section>

                <!--section class="content-box content-box--orange">
                    <h2 class="content-box__title">Свежие публикации раздела Проекты в формате слайдер</h2>

                    <div class="row">
                        <div class="col-md-4">
                            <a href="#" class="news-card news-card--orange">
                                <figure class="news-card__thumb"><img src="./public/uploads/news-05.jpg" alt="" /></figure>
                                <div class="news-card__info">
                                    <div class="news-card__info-part">Рубрика</div>
                                    <div class="news-card__info-date">3 августа 2021</div>
                                </div>
                                <div class="news-card__title">
                                    Прибрежная территория озера Пионер в Раменском преображается на глазах у жителей
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="news-card news-card--orange">
                                <figure class="news-card__thumb"><img src="./public/uploads/news-02.jpg" alt="" /></figure>
                                <div class="news-card__info">
                                    <div class="news-card__info-part">Рубрика</div>
                                    <div class="news-card__info-date">3 августа 2021</div>
                                </div>
                                <div class="news-card__title">
                                    На Раменском ипподроме отметили 95-летние города Раменское и 85-летие ипподрома
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="news-card news-card--orange">
                                <figure class="news-card__thumb"><img src="./public/uploads/news-01.jpg" alt="" /></figure>
                                <div class="news-card__info">
                                    <div class="news-card__info-part">Рубрика</div>
                                    <div class="news-card__info-date">3 августа 2021</div>
                                </div>
                                <div class="news-card__title">
                                    В День города у дворца спорта «Борисоглебский» состоялся фестиваль красок
                                </div>
                            </a>
                        </div>
                    </div>
                </section-->

                @if ($baner2->status)
                    <div class="banan">
                        <a href="{{$baner2->url}}"><img src="{{asset('public/storage/baners/'.$baner2->baner)}}" alt="" /></a>
                    </div>
                @endif

                <section class="content-box content-box--blue">
                    <h2 class="content-box__title">Гид по Раменскому городскому округу</h2>

                    <div class="row">
                        <div class="col-md-4">
                            <a href="#" class="guid-button-link">Поесть<br/> со вкусом!</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="guid-button-link">Где<br/> остановится?</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="guid-button-link">Заняться<br/> спортом!</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="guid-button-link">Что посмотреть?<br/> QR-коды</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="guid-button-link">Интересно<br/> с детьми</a>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="guid-button-link">Анонсы<br/> событий</a>
                        </div>
                    </div>
                </section>

            </div>
            @include('layouts.right_block')
        </div>

@endsection
