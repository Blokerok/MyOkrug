@extends('layouts.admin_layout')

@section('title', 'Редактировать Двор')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать двор: {{ $post['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('moy-dvor.index') }}">Все дворы</a>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
            @error('post_image')
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{{ $message }}</h4>
            </div>

            @enderror
            @error('post_images.*')
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
                        <form action="{{ route('moy-dvor.update', $post['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">SEO Title названия двора</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control"
                                           id="title" placeholder="Введите SEO Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" value="{{ $post['h1'] }}" name="h1" class="form-control"
                                           id="h1" placeholder="Введите название двора" required>
                                </div>
                                <div class="form-group">
                                    <label for="title">SEO Description</label>
                                    <input type="text" value="{{ $post['description'] }}" name="description"
                                           class="form-control"
                                           id="title" placeholder="Введите SEO Description" required>
                                </div>
                                <div class="form-group">
                                    <label for="alias">Алиас</label>
                                    <input type="text" value="{{ $post['alias'] }}" name="alias" class="form-control"
                                           id="alias" placeholder="Введите алиас двора" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Координаты двора</label>
                                    <input type="text" name="coord" class="form-control" id="coord" placeholder="Выбрать координаты" value="{{$post['coord'] }}" required>
                                </div>

                                <p class="header">Кликните по карте, чтобы указать и установить координаты двора</p>
                                <div id="map" style="width:100%;height:400px;"></div>

                                <script src="https://api-maps.yandex.ru/2.1/?apikey=d4764060-f47e-453f-8184-70c6cdea2e13&lang=ru_RU"></script>

                                <script>

                                    ymaps.ready(init);

                                    function init() {
                                        var myPlacemark,
                                            myMap = new ymaps.Map('map', {
                                                center: [{{$post['coord'] }}],
                                                zoom: 16
                                            }, {
                                                searchControlProvider: 'yandex#search'
                                            });

                                        myPlacemark = createPlacemark([{{$post['coord'] }}]);
                                        myMap.geoObjects.add(myPlacemark);
                                        myMap.cursors.push('pointer');

                                        // Слушаем событие окончания перетаскивания на метке.
                                        myPlacemark.events.add('dragend', function () {
                                            $('#coord').val(myPlacemark.geometry.getCoordinates());
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
                                                    iconImageHref: '/public/images/moy-dvor.png',
                                                    // Размеры метки.
                                                    iconImageSize: [50, 50],
                                                    // Смещение левого верхнего угла иконки относительно
                                                    // её "ножки" (точки привязки).
                                                    iconImageOffset: [-20, -20],
                                                    draggable: true
                                                });
                                        }
                                    }


                                </script>



                                <div class="form-group ">
                                    <label>Дата публикации записи</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input data-toggle="datetimepicker"
                                               value="@if($post->created_at){{date('d.m.Y H:i', strtotime($post->created_at))}}@endif"
                                               name="created_at" type="text" class="form-control datetimepicker-input"
                                               data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="shot_text" class="editor">{{ $post['shot_text'] }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Описание</label>
                                    <textarea name="text" class="editor">{{ $post['text'] }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="feature_image">Главное изображение двора</label>
                                    <img src="@if(file_exists(storage_path('app/public/moy_dvor/tumb/tumb-'.$post['img'])))
                                    {{asset('public/storage/moy_dvor/tumb/tumb-'.$post['img'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Дополнительные изображения двора</label>
                                    @if(count($post->images))
                                        <div class="post_images">
                                        @foreach($post->images as $img)
                                            <img src="{{asset('public/storage/moy_dvor/'.$img->img)}}" alt="" class="img-uploaded" style="display: block; width: 300px">

                                        @endforeach
                                        </div>
                                    @endif

                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input" id="post_images"
                                               name="post_images[]">
                                        <label class="custom-file-label" for="post_images">Выберите изображения</label>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
