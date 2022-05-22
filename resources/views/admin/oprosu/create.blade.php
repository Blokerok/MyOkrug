@extends('layouts.admin_layout')

@section('title', 'Добавить опрос')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить опрос</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->

            @error('post_image')
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
                        <form action="{{ route('oprosu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title опроса</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Title опроса" value="{{session('old.title')}}" required>
                                </div>

                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите группу опросов</label>
                                        <select name="group_id" class="form-control" required>
                                            <option disabled>Выбор категории</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}" @if(session('old.rubric_id')==$category['id']) selected @endif>{{ $category['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="text" class="editor">{{session('old.text')}}</textarea>
                                </div>

                                <div class="form-group ">
                                    <label> Остановить голосование в:</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input data-toggle="datetimepicker" autocomplete="off"
                                               value="{{session('old.stop')}}"
                                               name="stop" type="text" class="form-control datetimepicker-input"
                                               data-target="#reservationdate2" required/>
                                        <div class="input-group-append" data-target="#reservationdate2"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label for="post_image">Изображение для опроса</label>
                                    <img
                                        src="@if(file_exists(storage_path('app/public/page_image/'.session('old.img'))))
                                        {{asset('public/storage/page_image/'.session('old.img'))}}
                                        @endif" alt="" class="img-uploaded"
                                        style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="post_image">Варианты для опроса</label>
                                </div>
                                <div class="voproses">
                                    <div class="input-group input-group-sm" id="vopros1">
                                        <label for="">Вариант 1</label>
                                        <input type="text" name="vopros[]" class="form-control col-10" id="v1"  placeholder="Введите вариант" value="">

                                </div>

                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="self_answer"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                        Свой вариант ответа (включить в опрос)
                                    </label>
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
