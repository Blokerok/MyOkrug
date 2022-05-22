@extends('layouts.app_face')

@section('title')
    Фотоконкурсы
@endsection

@section('description')
    Фотоконкурсы
@endsection

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / Опросы</div>

            <h1>Опросы</h1>


            <div class="promo-box">
                <div class="promo-slider js-promo-slider">
                    @if(count($present_oproses))
                    @foreach($present_oproses as $opros)

                        <div class="promo-slider__item">
                            <a href="{{route('LinkOpros',[$opros->alias])}}" class="promo-slide2"
                               style="background-image: url({{asset('public/storage/page_image/'.$opros->img)}});">
                                <div class="promo-slide__wrap">
                                    <div class="promo-slide__title">{{$opros->title}}</div>
                                    <div class="promo-slide__info">
                                        <div class="promo-slide__info-part promo-slide__info-part--blue">Опрос
                                            проходит
                                        </div>
                                        <div
                                            class="promo-slide__info-date">Дата начала {{date('d.m.Y H:i', strtotime($opros->created_at))}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @else
                        <p>На данный момент, опросы не проводятся.</p>
                    @endif

                </div>

            </div>

            <div class="section-outer">
                <div class="row">
                @if(count($stop_oproses))

                        @foreach($stop_oproses as $opros)

                            <div class="col-md-4">
                                <a href="{{route('LinkOpros',[$opros->alias])}}" class="news-card news-card--green">
                                    <div class="marker">Завершен</div>
                                    <figure class="news-card__thumb"><img
                                            src="{{asset('public/storage/page_image/'.$opros->img)}}" alt=""/>
                                    </figure>
                                    <div class="news-card__title">
                                        {{$opros->title}}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @else
                            <p>Пока нет завершенных опросов.</p>
                        @endif
                    </div>
            </div>

        </div>
        @include('layouts.right_block')
    </div>

@endsection
