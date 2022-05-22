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

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / Фотоконкурсы</div>

            <h1>Фотоконкурсы</h1>


            <div class="promo-box fotobox">
                <div class="promo-slider js-promo-slider">
                    @foreach($present_konkurs as $konkurs)

                        <div class="promo-slider__item">
                            <a href="{{route('LinkKonkurs',[$konkurs->alias])}}" class="promo-slide"
                               style="background-image: url({{asset('public/storage/fotokonkurs_image/'.$konkurs->img)}});">
                                <div class="promo-slide__wrap">
                                    <div class="promo-slide__title">{{$konkurs->title}}</div>
                                    <div class="promo-slide__info">
                                        <div class="promo-slide__info-part promo-slide__info-part--blue">Конкурс
                                            проходит
                                        </div>
                                        <div
                                            class="promo-slide__info-date">Дата начала {{date('d.m.Y H:i', strtotime($konkurs->created_at))}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>

            </div>

            <div class="section-outer">
                <div class="row">
                @if(count($stop_konkurs))

                        @foreach($stop_konkurs as $konkurs)

                            <div class="col-md-4">
                                <a href="{{route('LinkKonkurs',[$konkurs->alias])}}" class="news-card news-card--green">
                                    <div class="marker">Завершен</div>
                                    <figure class="news-card__thumb"><img
                                            src="{{asset('public/storage/fotokonkurs_image/'.$konkurs->img)}}" alt=""/>
                                    </figure>
                                    <div class="news-card__title">
                                        {{$konkurs->title}}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @else
                            <p>Пока нет завершенных конкурсов.</p>
                        @endif
                    </div>
            </div>

        </div>
        @include('layouts.right_block')
    </div>

@endsection
