@extends('layouts.admin_layout')

@section('title', 'Добавить материал')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить материал</h1>
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
                        <form action="{{ route('odinvopros.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Введите название материала" value="{{session('old.title')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ссылка на youtube ролик</label>
                                    <input type="text" name="link_youtube" class="form-control" id="exampleInputEmail1" placeholder="Введите ссылку на youtube ролик" value="{{session('old.link_youtube')}}" required>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Сопроводительный текст к репортажу</label>
                                    <textarea name="text" class="editor" required>{{session('old.text')}}</textarea>
                                </div>


                                <div class="form-group">

                                    <label for="post_image">Изображение для материала</label>
                                    <img src="@if(file_exists(storage_path('app/public/news_image/'.session('old.img'))))
                                    {{asset('public/storage/news_image/'.session('old.img'))}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
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

    <!-- /.content -->
@endsection
