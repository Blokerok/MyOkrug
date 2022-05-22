@extends('layouts.admin_layout')

@section('title', 'Добавить участника конкурса')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить участника конкурса</h1>
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
                        <form action="{{ route('uchastniki-fotokonkursov.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название группы фотографий для конкурса</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Название группы фотографий" value="{{session('old.title')}}" required>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите конкурс</label>
                                        <select name="konkurs_id" class="form-control" required>
                                            @foreach ($konkurses as $konurs)
                                                <option value="{{ $konurs['id'] }}" @if(session('old.konkurs_id')==$konurs['id']) selected @endif>{{ $konurs['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">ФИО/имя приславшего</label>
                                    <input type="text" name="fio" class="form-control" id="fio" placeholder="ФИО/имя приславшего" value="{{session('old.fio')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail приславшего</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail приславшего" value="{{session('old.email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Телефон приславшего</label>
                                    <input  name="phone" class="form-control" id="phone" placeholder="Телефон приславшего" value="{{session('old.phone')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="text" class="editor" required>{{session('old.text')}}</textarea>
                                </div>


                                <div class="form-group">

                                    <label for="post_image">Главное изображение для участника конкурса</label>
                                    <img src="@if(file_exists(storage_path('app/public/fotokonkurs_image/'.session('old.img'))))
                                    {{asset('public/storage/fotokonkurs_image/'.session('old.img'))}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="feature_image">Дополнительные изображения до 10 фотографий</label>

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
