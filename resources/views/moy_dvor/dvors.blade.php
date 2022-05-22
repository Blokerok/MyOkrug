@extends('layouts.app_face')

@section('title')
    "Моя двор"
@endsection
@section('description','Мой двор')

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / "Мой двор"</div>

            <h1 class="content-box__title">Мой двор</h1>

            <section class="content-box content-box--blue-dark">


                <div class="row">
                    <div class="col-12 order-md-1">
                        <div class="map-box">
                            <div id="map"></div>
                        </div>

                        <script
                            src="https://api-maps.yandex.ru/2.1/?apikey=d4764060-f47e-453f-8184-70c6cdea2e13&lang=ru_RU"></script>

                        <script>


                            ymaps.ready(init);

                            function init() {

                                var myMap = new ymaps.Map('map', {
                                        center: [55.571804, 38.223244],
                                        zoom: 10,
                                        controls: ['zoomControl']
                                    }
                                );


                                myCol = new ymaps.GeoObjectCollection(null, {
                                    // Запретим появление балуна.
                                    hasBalloon: true,
                                    iconColor: '#3b5998'
                                });

                                var coords = {!!$coords!!};

                                for (var i = 0; i < coords.length; i++) {
                                    placemark = new ymaps.Placemark(coords[i].coord, {
                                        iconContent: i,
                                        balloonContent: coords[i].baloon
                                    }, {

                                        iconLayout: 'default#image',
                                        iconImageHref: '/public/images/moy-dvor.png',
                                        // Размеры метки.
                                        iconImageSize: [50, 50],
                                        iconImageOffset: [-20, -20],
                                        balloonShadow: true,
                                    });
                                    //добавляем метку в коллекцию
                                    myCol.add(placemark);
                                }


                                myMap.geoObjects.add(myCol);

                                myMap.setBounds(myMap.geoObjects.getBounds(), {checkZoomRange: true});


                            }

                        </script>

                    </div>
                    <div class="col-12 order-md-2">
                        <div class="object-list">

                            @if(count($dvors))
                                @foreach ($dvors as $new)
                                    <div class="object-list__item">
                                        <div class="object-card">
                                            <div class="object-card__addr">{{ $new->h1 }}</div>
                                            <div class="object-card__wrap">
                                                <a href="{{route('LinkDvor',[$new->alias])}}" class="news-card">
                                                    <figure class="news-card__thumb"><img
                                                            src="@if($new->img){{asset('public/storage/moy_dvor/tumb/tumb-'.$new->img)}}@else{{asset('public/uploads/news-03.jpg')}}@endif"
                                                            alt=""/></figure>
                                                </a>
                                                <div class="object-card__descr">
                                                    <div class="object-card__text">
                                                        {!! $new->shot_text !!}
                                                    </div>
                                                    <div class="object-card__more"><a
                                                            href="{{route('LinkDvor',[$new->alias])}}">Подробнее...</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="object-card__action">
                                                <a href="{{route('LinkDvor',[$new->alias])}}#mc-container"
                                                   class="gray-button">Комментировать</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>На портале пока нет информации по дворам.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </section>
        </div>

        @include('layouts.right_block')
    </div>

@endsection
