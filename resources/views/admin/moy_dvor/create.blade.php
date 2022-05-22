@extends('layouts.admin_layout')

@section('title', 'Добавить двор')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить двор</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->

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
                        <form action="{{ route('moy-dvor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title двора</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title двора" value="{{session('old.title')}}" required>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Координаты двора</label>
                                    <input type="text" name="coord" class="form-control" id="coord" placeholder="Выбрать координаты" value="{{session('old.coord')}}" required>
                                </div>

                                <p class="header">Кликните по карте, чтобы указать и установить координаты двора</p>
                                <div id="map" style="width:100%;height:400px;"></div>


                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="shot_text" class="editor" required>{{session('old.shot_text')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Подробное описание</label>
                                    <textarea name="text" class="editor" required>{{session('old.text')}}</textarea>
                                </div>




                                <div class="form-group">

                                    <label for="post_image">Главное изображение двора</label>
                                    <img src="@if(file_exists(storage_path('app/public/moy-dvor/'.session('old.img'))))
                                    {{asset('public/storage/moy-dvor/'.session('old.img'))}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="feature_image">Дополнительные изображения двора</label>

                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input" id="post_images"
                                               name="post_images[]">
                                        <label class="custom-file-label" for="post_images">Выберите изображения</label>
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
