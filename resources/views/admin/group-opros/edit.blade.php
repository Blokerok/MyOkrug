@extends('layouts.admin_layout')

@section('title', 'Редактирование категории')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование группы опросов: {{ $group['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
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
                        <form action="{{ route('groupu-oprosov.update', $group['id']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название группы опросов</label>
                                    <input type="text" value="{{ $group['title'] }}" name="title" class="form-control"
                                        id="exampleInputEmail1" placeholder="Введите название группы" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" value="{{ $group['h1'] }}" name="h1" class="form-control"
                                           id="h1" placeholder="Введите название страницы" required>
                                </div>
                                <div class="form-group">
                                    <label for="title">SEO Description</label>
                                    <input type="text" value="{{ $group['description'] }}" name="description"
                                           class="form-control"
                                           id="title" placeholder="Введите SEO Description" required>
                                </div>
                                <div class="form-group">
                                    <label for="alias">Алиас</label>
                                    <input type="text" value="{{ $group['alias'] }}" name="alias" class="form-control"
                                           id="alias" placeholder="Введите алиас страницы" required>
                                </div>

                                <div class="form-group ">
                                    <label>Дата публикации группы</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input data-toggle="datetimepicker"
                                               value="@if($group->created_at){{date('d.m.Y H:i', strtotime($group->created_at))}}@endif"
                                               name="created_at" type="text" class="form-control datetimepicker-input"
                                               data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="post_image">Добавьте текст для группы</label>
                                    <textarea name="text_page" class="editor">{{$group['text_page']}}</textarea>
                                </div>


                                <div class="form-group">

                                    <label for="post_image">Изображение для группы опросов</label>
                                    <img src="@if(file_exists(storage_path('app/public/page_image/'.$group['img'])))
                                    {{asset('public/storage/page_image/'.$group['img'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>

                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="stop" @if($group->stop) checked @endif value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                        Голосование по опросам закончено
                                    </label>
                                </div>
                            </div>


                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
