@extends('layouts.admin_layout')

@section('title', 'Редактировать информацию')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать информацию: {{ $post['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('info.index') }}">Все позиции</a>
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
                        <form action="{{ route('info.update', $post['id']) }}" method="POST"
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

                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control"
                                           id="title" placeholder="Название" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Телефон</label>
                                    <input type="text" value="{{ $post['phone'] }}" name="phone" class="form-control"
                                           id="h1" placeholder="Номер телефона">
                                </div>
                                <div class="form-group">
                                    <label for="title">Сайт</label>
                                    <input type="text" value="{{ $post['sait'] }}" name="sait"
                                           class="form-control"
                                           id="title" placeholder="Введите сайт">
                                </div>
                                <div class="form-group">
                                    <label for="alias">Телеграм</label>
                                    <input type="text" value="{{ $post['social_telegram'] }}" name="social_telegram" class="form-control"
                                           id="alias" placeholder="Введите Телеграм">
                                </div>
                                <div class="form-group">
                                    <label for="alias">ОК</label>
                                    <input type="text" value="{{ $post['social_ok'] }}" name="social_ok" class="form-control"
                                           id="alias" placeholder="Введите одноклассники">
                                </div>
                                <div class="form-group">
                                    <label for="alias">VK</label>
                                    <input type="text" value="{{ $post['social_vk'] }}" name="social_vk" class="form-control"
                                           id="alias" placeholder="Введите вконтакте">
                                </div>

                           <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите категорию</label>
                                        <select name="rubric_id" class="form-control" required>
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
                                    <label for="feature_image">Изображение</label>
                                    <img src="@if(file_exists(storage_path('app/public/info_image/'.$post['img'])))
                                    {{asset('public/storage/info_image/'.$post['img'])}}
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
