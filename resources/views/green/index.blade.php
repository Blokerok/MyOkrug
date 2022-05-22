@extends('layouts.app_face')

@section('title')
    "Озеленение"
@endsection
@section('description','Озеленение')

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="page-header">
                <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / Городское озеленение</div>
                <h1>Городское озеленение<br/> «Зеленая улица»</h1>
                <img src="{{ asset("public/images/zel-ul-logo.png")}}" alt="Зеленая улица" class="page-header__logo"/>
            </div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {!!  session('success') !!}
                </div>
            @endif

						<div class="about-box">
            <div class="about-box__wrap">
						<p><strong>«Зеленая улица» - проект городского озеленения, участие в котором может принять каждый житель Раменского.</strong></p>
						<p>Сервис позволяет всем желающим предложить места для высадки деревьев и кустарников, организации живых изгородей вдоль автодорог, указать территории, которые могут быть переформатированы в зеленые аллеи и скверы.</p>
						<p>За каждое предложенное место можно проголосовать.</p>
						<p>Предложения, которые станут востребованными и получат одобрение экспертов, войдут в программу озеленения.</p>
						<p>Но это ещё не всё! После того как места для высадки растений будут определены, жители смогут выбрать, какие именно деревья или кустарники будут расти на территории озеленения.</p>
						<p>При необходимости можно отправить заявку на кронирование или удаление аварийных деревьев.</p>
						<p><strong>Участвуйте! Предлагайте свои локации и/или голосуйте за уже предложенные варианты!</strong></p>

						<h2>Как участвовать?</h2>
						<ul>
							<li>Заполните <a href="/ozelenenie/new-ozelenenie">форму заявки</a>;</li>
							<li>После модерации ваше предложение появится на карте;</li>
							<li>Следите за результатами голосования и поддерживайте другие проекты.</li>
						</ul>
						<p>Внимание! В проекте могут принять участие только <a href="/register">зарегистрированные пользователи</a>.</p>

						<p><strong>Приём предложений и голосование продлятся до 31 марта 2022 г.</strong></p>
						</div>
						<div>
                    <span class="about-box__more" data-toggle-text="Скрыть">Читать целиком</span>
                </div>
						</div>

            <div class="map-box">
                <div id="map"></div>
            </div>

            <div class="map-action">
								<a href="{{route('creat_green')}}" class="button add_point"><img src="/img/dobav.svg" alt="Добавить свою точку для озеленения" title="Добавить свою точку для озеленения" /></a>
            </div>

            <div class="advantages">
                <div class="advantages__item">
                    <div class="advantage-card">
                        <div class="advantage-card__icon"><img src="{{ asset("public/images/zel-advantage-01.png")}}"
                                                               alt=""/></div>
                        <div class="advantage-card__title">
                            Высаживаем<br/>
                            деревья и кусты
                        </div>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantage-card">
                        <div class="advantage-card__icon"><img src="{{ asset("public/images/zel-advantage-02.png")}}"
                                                               alt=""/></div>
                        <div class="advantage-card__title">
                            Создаем зеленые<br/>
                            пространства
                        </div>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantage-card">
                        <div class="advantage-card__icon"><img src="{{ asset("public/images/zel-advantage-03.png")}}"
                                                               alt=""/></div>
                        <div class="advantage-card__title">
                            Кронируем или удаляем<br/>
                            аварийные деревья
                        </div>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantage-card">
                        <div class="advantage-card__icon"><img src="{{ asset("public/images/zel-advantage-04.png")}}"
                                                               alt=""/></div>
                        <div class="advantage-card__title">
                            Живые изгороди<br/>
                            вдоль дорог
                        </div>
                    </div>
                </div>
            </div>

            <script
                src="https://api-maps.yandex.ru/2.1/?apikey=d4764060-f47e-453f-8184-70c6cdea2e13&lang=ru_RU"></script>

            <script>


                ymaps.ready(init);

                var placemark = [];

                function init() {

                    var myMap = new ymaps.Map('map', {
                            center: [55.571804, 38.223244],
                            zoom: 13,
                        }, {
                            searchControlProvider: 'yandex#search'
                        }
                    );


                    myCol = new ymaps.GeoObjectCollection(null, {
                        // Запретим появление балуна.
                        hasBalloon: true,
                        iconColor: '#3b5998'
                    });

                    @foreach($points as $point)

                        placemark[{{$point->id}}] = new ymaps.Placemark([{{$point->coord_point}}], {
                        balloonContent: `
									<div class="balloon-card">
										<div class="balloon-card__title" style="background:{{$point->category->color}} !important;">{{$point->category->title}}</div>
										<div class="balloon-card__addr">{{$point->name_green}}</div>
										<div class="balloon-card__gallery">
											<div class="balloon-card__gallery-item">
								@if(file_exists(storage_path('app/public/green/tumb/tumb-'.$point['img1']))) <img src="{{asset('public/storage/green/tumb/tumb-'.$point['img1'])}}"/> @else<span class="blank-photo">Нет фото</span> @endif

                        </div>
                        <div class="balloon-card__gallery-item">
@if(file_exists(storage_path('app/public/green/tumb/tumb-'.$point['img2']))) <img src="{{asset('public/storage/green/tumb/tumb-'.$point['img2'])}}"/> @else<span class="blank-photo">Нет фото</span> @endif
                        </div>
                    </div>
                    <div class="balloon-card__descr">
{!! $point->info !!}
                        </div>

                        <div class="balloon-card__voting">
                           @if($point->present_voice())
                        <div class="balloon-card__voting-variant">
                            <b style="color:red">Вы уже проглосовали, спасибо!</b>
                        </div>
                          @else
                         @if(Auth::check()  && Auth::user()->email_verified_at!==NULL)
                        <div class="balloon-card__voting-variant {{$point->id}}">
                                            <a href="#" data-id="{{$point->id}}" class="button-yes">Да!</a>
                                            <a href="#" data-id="{{$point->id}}" class="button-no">Нет!</a>
                                        </div>
                                    @else
                            <div class="balloon-card__voting-title">Чтобы проголосовать требуется <a href="{{route('login')}}"><strong>авторизация</strong></a></div>
                         @endif
                        @endif

                        </div>

                        <div class="balloon-card__author">
                            <div class="balloon-card__author-name">Предложил: {{$point->user->login}}</div>
                                        <div class="balloon-card__author-id">ID: {{$point->id}}</div>
                                    </div>
                                </div>`
                    }, {

                        iconLayout: 'default#imageWithContent',
                        iconImageHref: '/public/images/zel-map-point.png',
                        // Размеры метки.
                        iconImageSize: [49, 72],
                        iconImageOffset: [-24, -72],
                        iconContentOffset: [15, 15],
                        balloonShadow: true,
                    });


                    //добавляем метку в коллекцию
                    myCol.add(placemark[{{$point->id}}]);

                    placemark[{{$point->id}}].events.add('click', function () {
                        myMap.setCenter([{{$point->coord_point}}], 16)

                    })

                    @endforeach

                        @foreach($poligons as $poligon)

                        polygon1 = new ymaps.GeoObject({
                            // Описываем геометрию геообъекта.
                            geometry: {
                                // Тип геометрии - "Многоугольник".
                                type: "Polygon",
                                // Указываем координаты вершин многоугольника.
                                coordinates: {{explode(':',$poligon->coord_poligon)[0]}},
                                // Задаем правило заливки внутренних контуров по алгоритму "nonZero".

                            },
                            // Описываем свойства геообъекта.
                            properties: {
                                // Содержимое балуна.
                                balloonContent: "Область id:{{$poligon->id}}"
                            }
                        },
                        {


                            fillColor: '{{explode(':',$poligon->coord_poligon)[1]}}',

                            strokeColor: '#254D66',

                            opacity: 0.5,

                            strokeOpacity: 0.8,

                            strokeWidth: 2
                        });


                    myMap.geoObjects.add(polygon1);
                    @endforeach




                    myMap.geoObjects.add(myCol);

                    myMap.setBounds(myMap.geoObjects.getBounds(), {checkZoomRange: true});


                }

            </script>
            <div class="balloon-list">

                @if(count($points))
                    @foreach($points as $point)
                        <div class="balloon-wrap">

                            <div class="balloon-card">
                                <div class="balloon-card__title"
                                     style="background:{{$point->category->color}} !important;">{{$point->category->title}}</div>
                                <div class="balloon-card__addr">{{$point->name_green}}</div>
                                <div class="balloon-card__gallery">
                                    <div class="balloon-card__gallery-item">
                                        @if(file_exists(storage_path('app/public/green/tumb/tumb-'.$point['img1']))) <a
                                            data-fancybox="gallery"
                                            href="{{asset('public/storage/green/'.$point->img1)}}" class="fb"><img
                                                src="{{asset('public/storage/green/tumb/tumb-'.$point['img1'])}}"/></a> @else
                                            <span class="blank-photo">Нет фото</span> @endif
                                    </div>
                                    <div class="balloon-card__gallery-item">
                                        @if(file_exists(storage_path('app/public/green/tumb/tumb-'.$point['img2']))) <a
                                            data-fancybox="gallery"
                                            href="{{asset('public/storage/green/'.$point->img2)}}" class="fb"><img
                                                src="{{asset('public/storage/green/tumb/tumb-'.$point['img2'])}}"/></a> @else
                                            <span class="blank-photo">Нет фото</span> @endif
                                    </div>
                                </div>
                                <div class="balloon-card__descr">
                                    {!! $point->info !!}
                                </div>


                                <div class="balloon-card__voting">
                                    @if($point->present_voice())
                                        <div class="balloon-card__voting-variant">
                                            <b style="color:red">Вы уже проголосовали, спасибо!</b>
                                        </div>
                                    @else
                                        @if(Auth::check()  && Auth::user()->email_verified_at!==NULL)
                                            <div class="balloon-card__voting-variant {{$point->id}}">
                                                <a href="#" data-id="{{$point->id}}" class="button-yes">Да!</a>
                                                <a href="#" data-id="{{$point->id}}" class="button-no">Нет!</a>
                                            </div>
                                        @else
                                            <div class="balloon-card__voting-title">Чтобы проголосовать требуется <a
                                                    href="{{route('login')}}"><strong>авторизация</strong></a></div>
                                        @endif
                                    @endif

                                </div>

                                <div class="balloon-card__author">
                                    <div class="balloon-card__author-name">Предложил: {{$point->user->login}}</div>
                                    <div class="balloon-card__author-id">ID: {{$point->id}}</div>
                                </div>
                            </div>

                        </div>

                    @endforeach

                @else
                    <p>Пока нет предложений на озеленение.</p>
                @endif

            </div>

        </div>

        @include('layouts.right_block')
    </div>

@endsection
