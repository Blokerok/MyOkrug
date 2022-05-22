@extends('layouts.admin_layout')

@section('title', 'Добавить двор')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить озеленение</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->

            @error('post_image1')
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{{ $message }}</h4>
            </div>
            @enderror

            @error('post_image2')
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{{ $message }}</h4>
            </div>

            @enderror



            @if (session('error_img'))
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('error_img') }}</h4>
                </div>
            @endif


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('ozelenenie.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" name="name_green" class="form-control" id="name_green" placeholder="Название" value="{{session('old.name_green')}}" required>
                                </div>

                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите категорию озеленения</label>
                                        <select name="category_id" class="form-control" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}">{{ $category['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Координаты где предполагается озеленение</label>
                                    <input type="text" name="coord_point" class="form-control" id="coord" placeholder="Выбрать координаты" value="{{session('old.coord_point')}}" required>
                                </div>
                                <p class="header">Кликните по карте, чтобы указать и установить координаты работ по озеленению, а также нарисуйте области озеленения (работ)</p>

                                <div id="map" style="width:100%; height:600px"></div>
                                <div id="geometry"></div>


                                <table border="0" cellspacing="3" cellpadding="3">
                                    <tbody>
                                    <tr>
                                        <td width="100%" valign="top">
                                            <div id="formpolygon">
                                                <strong>Форма управления вводом областей:</strong><br>
                                                <div class="form-group">
                                                    <label>Цвет заливки:</label>
                                                    <input class="form-control my-colorpicker1" type="text" id="color_polygon" value="#4A9E5C"/>
                                                    <div>

                                                        <input type="hidden" id="fillopacity_polygon" value="0.5">
                                                        <input type="hidden" name="width_line" id="width_line" size="2" value="2"><br>
                                                        <input type="hidden" id="color_line" value="#254D66">
                                                        <input type="hidden" id="opacity_line" value="0.8">
                                                        <p><input class="btn btn-primary" type="button" value="Добавить" id="addPolygon"> <input class="btn btn-primary" type="button" value="Удалить последнюю добавленную" id="dellPolygon"></p>
                                                        <p><input class="btn btn-primary"   type="button" value="Завершить добавление области" id="stopEditPolygon"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody></table>

                                <div id="poligons" class="form-group">
                                    <label for="exampleInputEmail1">Координаты областей озеленения</label>

                                </div>


                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="info" class="editor" required>{{session('old.info')}}</textarea>
                                </div>



                                <div class="form-group">

                                    <label for="post_image">Фото 1</label>
                                    <img src="@if(file_exists(storage_path('app/public/green/'.session('old.img1'))))
                                    {{asset('public/storage/green/'.session('old.img1'))}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image1" name="post_image1">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label for="post_image">Фото 2</label>
                                    <img src="@if(file_exists(storage_path('app/public/green/'.session('old.img2'))))
                                    {{asset('public/storage/green/'.session('old.img2'))}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image2" name="post_image2">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>

                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=d4764060-f47e-453f-8184-70c6cdea2e13&lang=ru_RU"></script>
    <script>

        ymaps.ready(init);

        var polygon=[];
        var p = 0;

        function init() {


            var myPlacemark,
                myMap = new ymaps.Map('map', {
                    center: [55.571804,38.223244],
                    zoom: 14
                }, {
                    searchControlProvider: 'yandex#search'
                });
            myMap.cursors.push('pointer');



            myMap.events.add('click', function (e) {
                var coords = e.get('coords');

                // Если метка уже создана – просто передвигаем ее.
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                // Если нет – создаем.
                else {
                    myPlacemark = createPlacemark(coords);
                    myMap.geoObjects.add(myPlacemark);
                    // Слушаем событие окончания перетаскивания на метке.
                    myPlacemark.events.add('dragend', function () {
                        $('#coord').val(myPlacemark.geometry.getCoordinates());
                    });
                }
                $('#coord').val(coords);
            });

            // Создание метки.
            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {
                        iconCaption: 'Укажите координаты озеленения'
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
                        draggable: true
                    });
            }


            // Обработка нажатия на кнопку Добавить
            $('#addPolygon').click(


                function () {

                    var color_polygon = $('#color_polygon').val();
                    var fillopacity_polygon = $('#fillopacity_polygon').val();
                    var width_line = $('#width_line').val();
                    var color_line = $('#color_line').val();
                    var opacity_line = $('#opacity_line').val();

                    $('#stopEditPolygon').attr('disabled', false);



                    if( $(".form-control.col-8").length)
                        p = $(".form-control.col-8").length
                    else
                        p = 0;


                    polygon[p] = new ymaps.Polygon([[]],

                        {},
                        {

                            fillColor: color_polygon,

                            strokeColor: color_line,

                            opacity: fillopacity_polygon,

                            strokeOpacity: opacity_line,

                            strokeWidth: width_line
                        });



                    myMap.geoObjects.add(polygon[p]);


                    polygon[p].editor.startDrawing();

                    $('#addPolygon').attr('disabled', true);

                });
            // Обработка нажатия на кнопку Завершить редактирование
            $('#stopEditPolygon').click(
                function () {
                    if( $(".form-control.col-8").length)
                        p = $(".form-control.col-8").length

                    polygon[p].editor.stopEditing();
                    printGeometry(polygon[p].geometry.getCoordinates());
                    $('#stopEditPolygon').attr('disabled', true);
                    $('#addPolygon').attr('disabled', false);

                });


            // Обработка нажатия на кнопку Удалить
            $('#dellPolygon').click(
                function () {

                    if( $(".form-control.col-8").length)
                        p = $(".form-control.col-8").length

                    myMap.geoObjects.remove(polygon[p-1]);

                    polygon.splice(p-1,1);

                    console.log(polygon);

                    r = $(".form-control.col-8").length;
                    $('#poligon_'+r).remove();
                    $('#addPolygon').attr('disabled', false);

                });

            function printGeometry (coords) {

                var color_polygon = $('#color_polygon').val();

                var r=1
                 r += $(".form-control.col-8").length;
                $("#poligons").append('<div class="input-group input-group-sm" id="poligon_'+r+'"><input type="text" name="coord_poligons[]" class="form-control col-8" value="'+stringify(coords)+':'+color_polygon+'"></div>');

                function stringify (coords) {
                    var res = '';
                    if ($.isArray(coords)) {
                        res = '[ ';
                        for (var i = 0, l = coords.length; i < l; i++) {
                            if (i > 0) {
                                res += ', ';
                            }
                            res += stringify(coords[i]);
                        }
                        res += ' ]';
                    } else if (typeof coords == 'number') {
                        res = coords.toPrecision(8);
                    } else if (coords.toString) {
                        res = coords.toString();
                    }

                    return res;
                }
            }

        }


    </script>

    <!-- /.content -->
@endsection
