@extends('layouts.admin_layout')

@section('title', 'Добавить фотоконкурс')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить фотоконкурс</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
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
                        <form action="{{ route('fotokonkurs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название фотоконкурса</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="{{session('old.title')}}"
                                        placeholder="Введите название фотоконкурса" required>
                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="category_need" value="1"
                                           id="checkboxSuccess3">
                                    <label for="checkboxSuccess3">
                                        Включить категории для участников
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Описание фотоконкурса</label>
                                    <textarea name="text" class="editor" required>{{session('old.text')}}</textarea>
                                </div>


                                <div class="form-group">

                                    <label for="post_image">Изображение для списка и галереи фотоконкурсов рекомендованный размер 965 на 422</label>
                                    <img src="@if(file_exists(storage_path('app/public/fotokonkurs_image/'.session('old.img'))))
                                    {{asset('public/storage/news_image/'.session('old.img'))}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Выберите изображение</label>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="post_image">Банер на странице описания конкурса рекомендованный размер 994 на 208</label>
                                    <img src="@if(file_exists(storage_path('app/public/fotokonkurs_image/'.session('old.baner'))))
                                    {{asset('public/storage/news_image/'.session('old.baner'))}}
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
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
