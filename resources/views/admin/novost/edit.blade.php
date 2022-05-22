@extends('layouts.admin_layout')

@section('title', 'Редактировать статью')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать статью: {{ $post['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('novost.index') }}">Все статьи</a>
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
                        <form action="{{ route('novost.update', $post['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="public" @if($post->public) checked @endif value="1"
                                           id="checkboxSuccess2">
                                    <label for="checkboxSuccess2">
                                        Опубликовать
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="report" @if($post->report) checked @endif value="1"
                                           id="checkboxSuccess3">
                                    <label for="checkboxSuccess3">
                                        Для отчета
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="title">SEO Title</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control"
                                           id="title" placeholder="Введите SEO Title статьи" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" value="{{ $post['h1'] }}" name="h1" class="form-control"
                                           id="h1" placeholder="Введите название статьи" required>
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
                                    <label>Дата публикации статьи</label>
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

                                    <input type="checkbox" name="new_day" @if($post->new_day) checked @endif value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                        Новость дня
                                    </label>
                                </div>



                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите категорию</label>
                                        <select name="id_rubric" class="form-control" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}"
                                                        @if ($category['id'] == $post['rubric_id']) selected
                                                    @endif>{{ $category['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea name="text" class="editor">{{ $post['text'] }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Изображение статьи</label>
                                    <img src="@if(file_exists(storage_path('app/public/news_image/'.$post['img'])))
                                    {{asset('public/storage/news_image/'.$post['img'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Дополнительные изображения для статьи</label>
                                    @if(count($post->images))
                                        <div class="post_images">
                                        @foreach($post->images as $img)
                                            <img src="{{asset('public/storage/news_image/'.$img->img)}}" alt="" class="img-uploaded" style="display: block; width: 300px">
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
