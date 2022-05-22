@extends('layouts.admin_layout')

@section('title', 'Редактировать участие в конкурсе')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать участие в конкурсе: {{ $post['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('uchastniki-fotokonkursov.index') }}">Все участники</a>
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
                        <form action="{{ route('uchastniki-fotokonkursov.update', $post['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">SEO Title названия группы фотографий</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control"
                                           id="title" placeholder="Введите SEO Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" value="{{ $post['h1'] }}" name="h1" class="form-control"
                                           id="h1" placeholder="Введите название группы фотографий" required>
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
                                           id="alias" placeholder="Введите алиас группы фотографий" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">ФИО/имя приславшего</label>
                                    <input type="text" name="fio" class="form-control" id="fio" placeholder="ФИО/имя приславшего" value="{{$post['fio']}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail приславшего</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail приславшего" value="{{$post['email']}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Телефон приславшего</label>
                                    <input  name="phone" class="form-control" id="phone" placeholder="Телефон приславшего" value="{{$post['phone']}}" required>
                                </div>

                                <div class="form-group ">
                                    <label>Дата публикации участия</label>
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
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите конкурс</label>
                                        <select name="konkurs_id" class="form-control" required>
                                            @foreach ($konkurses as $category)
                                                <option value="{{ $category['id'] }}"
                                                        @if ($category['id'] == $post['konkurs_id']) selected
                                                    @endif>{{ $category['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="text" class="editor">{{ $post['text'] }}</textarea>
                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="moder" @if($post->moder) checked @endif value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                        Модерация (включить)
                                    </label>
                                </div>



                                <div class="form-group">
                                    <label for="feature_image">Главное изображение для участника конкурса</label>
                                    <img src="@if(file_exists(storage_path('app/public/fotokonkurs_image/tumb/tumb-'.$post['img'])))
                                    {{asset('public/storage/fotokonkurs_image/tumb/tumb-'.$post['img'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Дополнительные изображения до 10 фотографий</label>
                                    @if(count($post->images))
                                        <div class="post_images">
                                        @foreach($post->images as $img)
                                            <div style="float:left">
                                              <img src="{{asset('public/storage/fotokonkurs_image/'.$img->img)}}" alt="" class="img-uploaded" style="display: block; width: 300px">
                                                <input type="checkbox" name="rotate_right[]"  value="{{$img->id}}">
                                                <label>
                                                    Вращать
                                                </label>

                                                    <input type="checkbox" name="img_delete[]"  value="{{$img->id}}">
                                                    <label>
                                                        Удалить
                                                    </label>
                                            </div>

                                        @endforeach
                                        </div>
                                    @endif

                                    <div class="custom-file">
                                        <input type="file" multiple class="custom-file-input" id="post_images"
                                               name="post_images[]">
                                        <label class="custom-file-label" for="post_images">Выберите изображения</label>
                                    </div>
                                </div>
                                 <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="winer" @if($post->winer) checked @endif value="1"
                                           id="checkboxSuccess2">
                                    <label for="checkboxSuccess2">
                                        Победитель фотоконкурса
                                    </label>
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
