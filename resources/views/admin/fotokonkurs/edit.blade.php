@extends('layouts.admin_layout')

@section('title', 'Редактировать фотоконкурс')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать фотококурс: {{ $post['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('fotokonkurs.index') }}">Все фотоконкурсы</a>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
            @error('image')
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{{ $message }}</h4>
            </div>
            @enderror

            @error('baner')
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
                        <form action="{{ route('fotokonkurs.update', $post['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">SEO Title</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control"
                                           id="title" placeholder="Введите SEO Title статьи" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" value="{{ $post['h1'] }}" name="h1" class="form-control"
                                           id="h1" placeholder="Введите название фотоконкурса" required>
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
                                           id="alias" placeholder="Введите алиас статьи" required>
                                </div>

                                <div class="form-group ">
                                    <label>Дата старта фотоконкурса</label>
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

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" @if($post->category_need) checked @endif name="category_need" value="1"
                                           id="checkboxSuccess3">
                                    <label for="checkboxSuccess3">
                                        Включить категории для участников
                                    </label>
                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="stop" @if($post->stop) checked @endif value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                        Остановка фотоконкурса
                                    </label>
                                </div>


                                <div class="form-group">
                                    <textarea name="text" class="editor">{{ $post['text'] }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Изображение для списка и галереи фотоконкурсов рекомендованный размер 965 на 422</label>
                                    <img src="@if(file_exists(storage_path('app/public/fotokonkurs_image/'.$post['img'])))
                                    {{asset('public/storage/fotokonkurs_image/'.$post['img'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Выберите изображение</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Банер на странице описания конкурса рекомендованный размер 994 на 208</label>
                                    <img src="@if(file_exists(storage_path('app/public/fotokonkurs_image/'.$post['baner'])))
                                    {{asset('public/storage/fotokonkurs_image/'.$post['baner'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="baner" name="baner">
                                        <label class="custom-file-label" for="baner">Выберите изображение</label>
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
