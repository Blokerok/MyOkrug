@extends('layouts.app_face')

@section('title','Создать озеленение')
@section('description','Принять участие в конкурсе')

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="page-header">
                <div class="breadcrumbs"><a href="https://xn--c1aldgkbpy.xn--p1ai">Главная</a> / <a href="{{route('indexGreen')}}"> Озеленение </a> / Создать озеленение</div>
                <h1>Городское озеленение<br/> «Зеленая улица»</h1>
                <img src="{{ asset("public/images/zel-ul-logo.png")}}" alt="Зеленая улица" class="page-header__logo"/>
            </div>

            <section class="content-box content-box--full">
                <h2 class="content-box__title">Добавьте ваше предложение по городскому озеленению</h2>
                <div class="feedback-form forms">
            <form class="reg-form forms forms--blue-dark" method="POST" action="{{route('store_green')}}" enctype="multipart/form-data">
                @csrf




                        <div class="forms__field">
                            <label>Категория</label>
                            <select name="category_id" class="@error('category_id')is-invalid @enderror" >
                                <option selected disabled>Выберите категорию</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id==session('old.category_id') )selected @endif>{{$category->title}}</option>

                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="forms__field">
                            <label>Название</label>
                            <input type="text" name="name_green" value="{{session('old.name_green')}}" class="@error('name_green')is-invalid @enderror">
                            @error('name_green')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="forms__field">
                            <label>Описание</label>
                            <textarea name="info" class="@error('info')is-invalid @enderror">{{session('old.info')}}</textarea>
                            @error('info')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="forms__field">
                            <label>Фото 1</label>

                            <div class="input-file">
                                <span class="input-file__field"></span>
                                <span class="input-file__button">Обзор</span>
                                <input type="file" name="post_image1">
                                @error('post_image1')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="forms__field">
                            <label>Фото 2</label>

                            <div class="input-file">
                                <span class="input-file__field"></span>
                                <span class="input-file__button">Обзор</span>
                                <input type="file" name="post_image2">
                                @error('post_image2')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="forms__field">
                            <label>Место расположения точки озеленения</label>
                            <input type="text" id="coord" name="coord_point" value="{{session('old.coord_point')}}" class="@error('coord_point')is-invalid @enderror">
                            @error('coord_point')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="forms__field forms__field--full">
                            <label>Укажите на карте расположение объекта</label>
                            <div class="forms__map">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="forms__field">
                            <label></label>
                            <button class="button button--green">Отправить</button>
                        </div>

                        </form>
                    </div>

                </section>



            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=bd9dfbcd-b1c4-4b80-b236-78abcc292c4c"
                    type="text/javascript"></script>
            <script>
                ymaps.ready(init);

                function init() {
                    var myPlacemark,
                        myMap = new ymaps.Map('map', {
                            center: [55.571804,38.223244],
                            zoom: 14
                        }, {
                            searchControlProvider: 'yandex#search'
                        });
                    myMap.cursors.push('pointer');

                   var  polygon = new ymaps.GeoObject({
                            // Описываем геометрию геообъекта.
                            geometry: {
                                // Тип геометрии - "Многоугольник".
                                type: "Polygon",
                                // Указываем координаты вершин многоугольника.
                                coordinates:[ [ [ 55.5580, 38.2332 ], [ 55.5575, 38.2338 ], [ 55.5577, 38.2356 ], [ 55.5523, 38.2374 ], [ 55.5520, 38.2391 ], [ 55.5518, 38.2407 ], [ 55.5530, 38.2438 ], [ 55.5547, 38.2462 ], [ 55.5563, 38.2478 ], [ 55.5514, 38.2575 ], [ 55.5484, 38.2649 ], [ 55.5461, 38.2764 ], [ 55.5440, 38.2746 ], [ 55.5419, 38.2831 ], [ 55.5405, 38.2820 ], [ 55.5419, 38.2707 ], [ 55.5432, 38.2592 ], [ 55.5402, 38.2578 ], [ 55.5374, 38.2519 ], [ 55.5332, 38.2340 ], [ 55.5397, 38.2316 ], [ 55.5436, 38.2118 ], [ 55.5414, 38.2093 ], [ 55.5360, 38.2071 ], [ 55.5301, 38.2070 ], [ 55.5170, 38.2159 ], [ 55.5026, 38.2251 ], [ 55.5003, 38.2318 ], [ 55.4920, 38.2278 ], [ 55.4926, 38.2444 ], [ 55.4867, 38.2867 ], [ 55.4880, 38.3072 ], [ 55.4855, 38.3131 ], [ 55.4807, 38.3178 ], [ 55.4794, 38.3448 ], [ 55.4814, 38.3475 ], [ 55.4904, 38.3162 ], [ 55.5015, 38.3014 ], [ 55.5148, 38.2785 ], [ 55.5165, 38.2756 ], [ 55.5226, 38.2869 ], [ 55.5308, 38.3131 ], [ 55.5418, 38.2863 ], [ 55.5454, 38.2901 ], [ 55.5530, 38.2741 ], [ 55.5557, 38.2781 ], [ 55.5552, 38.2835 ], [ 55.5591, 38.2939 ], [ 55.5619, 38.2923 ], [ 55.5722, 38.2838 ], [ 55.5763, 38.2730 ], [ 55.5770, 38.2671 ], [ 55.5793, 38.2573 ], [ 55.5770, 38.2538 ], [ 55.5779, 38.2522 ], [ 55.5775, 38.2488 ], [ 55.5799, 38.2506 ], [ 55.5807, 38.2476 ], [ 55.5851, 38.2474 ], [ 55.5864, 38.2424 ], [ 55.5874, 38.2436 ], [ 55.5890, 38.2449 ], [ 55.5876, 38.2505 ], [ 55.5910, 38.2544 ], [ 55.5871, 38.2618 ], [ 55.5891, 38.2674 ], [ 55.5922, 38.2673 ], [ 55.5916, 38.2706 ], [ 55.5894, 38.2725 ], [ 55.5876, 38.2696 ], [ 55.5839, 38.2664 ], [ 55.5831, 38.2717 ], [ 55.5802, 38.2715 ], [ 55.5764, 38.2857 ], [ 55.5713, 38.2926 ], [ 55.5768, 38.3028 ], [ 55.5867, 38.2980 ], [ 55.5922, 38.2901 ], [ 55.5942, 38.2919 ], [ 55.5952, 38.2876 ], [ 55.5971, 38.2871 ], [ 55.5985, 38.2882 ], [ 55.5988, 38.2910 ], [ 55.5987, 38.2920 ], [ 55.6030, 38.2928 ], [ 55.6042, 38.3012 ], [ 55.6006, 38.3092 ], [ 55.5988, 38.3123 ], [ 55.5989, 38.3152 ], [ 55.6057, 38.3055 ], [ 55.6042, 38.2924 ], [ 55.6045, 38.2854 ], [ 55.6071, 38.2748 ], [ 55.6092, 38.2726 ], [ 55.6004, 38.2624 ], [ 55.6070, 38.2587 ], [ 55.6083, 38.2508 ], [ 55.6080, 38.2481 ], [ 55.6060, 38.2464 ], [ 55.6046, 38.2452 ], [ 55.6033, 38.2474 ], [ 55.6016, 38.2492 ], [ 55.6004, 38.2472 ], [ 55.6001, 38.2380 ], [ 55.5969, 38.2358 ], [ 55.5964, 38.2336 ], [ 55.5969, 38.2316 ], [ 55.5993, 38.2246 ], [ 55.6000, 38.2201 ], [ 55.5989, 38.2147 ], [ 55.5968, 38.2136 ], [ 55.5942, 38.2048 ], [ 55.5892, 38.1895 ], [ 55.5886, 38.1901 ], [ 55.5880, 38.1909 ], [ 55.5819, 38.1832 ], [ 55.5766, 38.1762 ], [ 55.5774, 38.1725 ], [ 55.5760, 38.1724 ], [ 55.5736, 38.1718 ], [ 55.5728, 38.1701 ], [ 55.5715, 38.1749 ], [ 55.5715, 38.1766 ], [ 55.5694, 38.1767 ], [ 55.5692, 38.1724 ], [ 55.5679, 38.1724 ], [ 55.5671, 38.1738 ], [ 55.5662, 38.1738 ], [ 55.5643, 38.1762 ], [ 55.5625, 38.1778 ], [ 55.5629, 38.1796 ], [ 55.5648, 38.1797 ], [ 55.5663, 38.1901 ], [ 55.5656, 38.1933 ], [ 55.5645, 38.1933 ], [ 55.5632, 38.1919 ], [ 55.5601, 38.1998 ], [ 55.5583, 38.2042 ], [ 55.5550, 38.2050 ], [ 55.5545, 38.2088 ], [ 55.5543, 38.2105 ], [ 55.5535, 38.2100 ], [ 55.5531, 38.2122 ], [ 55.5565, 38.2157 ], [ 55.5560, 38.2167 ], [ 55.5559, 38.2194 ], [ 55.5534, 38.2176 ], [ 55.5537, 38.2207 ], [ 55.5539, 38.2219 ], [ 55.5497, 38.2216 ], [ 55.5490, 38.2206 ], [ 55.5456, 38.2265 ], [ 55.5490, 38.2294 ], [ 55.5525, 38.2288 ], [ 55.5551, 38.2270 ], [ 55.5571, 38.2268 ], [ 55.5573, 38.2292 ], [ 55.5570, 38.2311 ], [ 55.5580, 38.2332 ] ], [ [ 55.5342, 38.2979 ], [ 55.5349, 38.2998 ], [ 55.5339, 38.3011 ], [ 55.5324, 38.3003 ], [ 55.5308, 38.2989 ], [ 55.5304, 38.2951 ], [ 55.5289, 38.2925 ], [ 55.5273, 38.2951 ], [ 55.5267, 38.2939 ], [ 55.5262, 38.2895 ], [ 55.5227, 38.2843 ], [ 55.5222, 38.2821 ], [ 55.5226, 38.2808 ], [ 55.5240, 38.2809 ], [ 55.5255, 38.2835 ], [ 55.5259, 38.2865 ], [ 55.5261, 38.2847 ], [ 55.5268, 38.2836 ], [ 55.5288, 38.2839 ], [ 55.5281, 38.2863 ], [ 55.5296, 38.2875 ], [ 55.5315, 38.2870 ], [ 55.5327, 38.2877 ], [ 55.5334, 38.2894 ], [ 55.5373, 38.2897 ], [ 55.5373, 38.2916 ], [ 55.5356, 38.2929 ], [ 55.5342, 38.2979 ] ], [ [ 55.5989, 38.2164 ], [ 55.5979, 38.2148 ], [ 55.5964, 38.2144 ], [ 55.5953, 38.2144 ], [ 55.5935, 38.2160 ], [ 55.5913, 38.2185 ], [ 55.5877, 38.2222 ], [ 55.5864, 38.2233 ], [ 55.5851, 38.2222 ], [ 55.5832, 38.2321 ], [ 55.5905, 38.2362 ], [ 55.5923, 38.2370 ], [ 55.5931, 38.2402 ], [ 55.5947, 38.2404 ], [ 55.5956, 38.2396 ], [ 55.5957, 38.2383 ], [ 55.5957, 38.2363 ], [ 55.5951, 38.2343 ], [ 55.5964, 38.2320 ], [ 55.5975, 38.2284 ], [ 55.5991, 38.2232 ], [ 55.5992, 38.2198 ], [ 55.5989, 38.2164 ] ] ],
                                // Задаем правило заливки внутренних контуров по алгоритму "nonZero".

                            }
                        },
                        {

                            fillColor: '#28b34c',

                            strokeColor: '#FF0000',

                            opacity: 0.3,

                            strokeOpacity: 0,

                            strokeWidth: 3,
                            interactivityModel : 'default#transparent'
                        });



                    myMap.geoObjects.add(polygon);

                    myMap.setBounds(myMap.geoObjects.getBounds(),{checkZoomRange: true});

                    myMap.events.add('click', function (e) {
                        var coords = e.get('coords');

                        // Если метка уже создана – просто передвигаем ее.
                        if (myPlacemark) {
                           /* if (!polygon.geometry.contains(coords))
                            { swal({
                                icon: "error",
                                text: "Точка может быть указана только в границах Раменского!",
                            });  return false; }
                                else */
                            myPlacemark.geometry.setCoordinates(coords);
                        }
                        // Если нет – создаем.
                        else {
                         /*   if (!polygon.geometry.contains(coords)) { swal({
                                icon: "error",
                                text: "Точка может быть указана только в границах Раменского!",
                            }); return false; } */
                            myPlacemark = createPlacemark(coords);
                            myMap.geoObjects.add(myPlacemark);
                            // Слушаем событие окончания перетаскивания на метке.
                            myPlacemark.events.add('dragend', function () {
                               // if (polygon.geometry.contains(myPlacemark.geometry.getCoordinates()))
                                $('#coord').val(myPlacemark.geometry.getCoordinates());
                              /*  else { swal({
                                    icon: "error",
                                    text: "Точка может быть указана только в границах Раменского!",
                                });   myPlacemark.geometry.setCoordinates(coords); };
                                */
                            });
                        }



                        $('#coord').val(coords);


                    });
                    // Создание метки.
                    function createPlacemark(coords) {
                        return new ymaps.Placemark(coords, {
                                iconCaption: 'Укажите координаты двора'
                            },
                            {
                                // Опции.
                                // Необходимо указать данный тип макета.
                                iconLayout: 'default#image',
                                // Своё изображение иконки метки.
                                iconImageHref: '/public/images/zel-map-point.png',
                                // Размеры метки.
                                iconImageSize: [49, 72],
                                iconImageOffset: [-24, -72],
                                iconContentOffset: [15, 15],
                                balloonShadow: true,
                                draggable: true
                            });
                    }
                }
            </script>


        </div>



        @include('layouts.right_block')
    </div>

@endsection
