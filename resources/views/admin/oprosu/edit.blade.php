@extends('layouts.admin_layout')

@section('title', 'Редактировать Опрос')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать опрос: {{ $post['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('oprosu.index') }}">Все опросы</a>
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
                        <form action="{{ route('oprosu.update', $post['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title названия опроса</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control"
                                           id="title" placeholder="Введите SEO Title" required>
                                </div>

                                <div class="form-group">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Выберите категорию</label>
                                        <select name="group_id" class="form-control" required>
                                            <option disabled>Выбор категории</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}" @if($post['group_id']==$category['id']) selected @endif>{{ $category['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group ">
                                    <label>Дата публикации опроса</label>
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

                                <div class="form-group ">
                                    <label> Остановить голосование в:</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input data-toggle="datetimepicker" autocomplete="off"
                                               value="@if($post->stop){{date('d.m.Y H:i', strtotime($post->stop))}}@endif"
                                               name="stop" type="text" class="form-control datetimepicker-input"
                                               data-target="#reservationdate2" required/>
                                        <div class="input-group-append" data-target="#reservationdate2"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>





                                <div class="form-group">
                                    <label for="post_image">Краткое описание</label>
                                    <textarea name="text" class="editor">{{ $post['text'] }}</textarea>
                                </div>



                                <div class="form-group">
                                    <label for="feature_image">Изображение для опроса</label>
                                    <img src="@if(file_exists(storage_path('app/public/page_image/'.$post['img'])))
                                    {{asset('public/storage/page_image/'.$post['img'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="post_image" name="post_image">
                                        <label class="custom-file-label" for="post_image">Выберите изображение</label>
                                    </div>
                                </div>

                                <div class="voproses">
                                    <div class="form-group">
                                        <label for="post_image">Варианты для опроса</label>
                                    </div>
                                  @foreach($post->voproses as $vopros)

                                        <div class="input-group input-group-sm" id="vopros_old{{ $loop->iteration }}">
                                            <label for="">Вариант {{ $loop->iteration }}</label>
                                            <input type="text" name="old_vopros[{{$vopros->id}}]" class="form-control col-10" id="v{{ $loop->iteration }}"  placeholder="Введите вариант" value="{{$vopros->vopros}}">
                                            <div class="input-group-append"><button type="button" data-vopros="{{$vopros->id}}" data-block="{{$loop->iteration}}" class="btn btn-danger btn-sm delvopros_old"><i class="fas fa-trash"></i>Удалить</button></div>
                                        </div>



                                  @endforeach

                                      <div class="input-group input-group-sm" id="vopros{{ count($post->voproses)+1 }}">
                                        <label for="">Вариант {{ count($post->voproses)+1 }}</label>
                                        <input type="text" name="vopros[]" class="form-control col-10" id="v{{count($post->voproses)+1}}"  placeholder="Введите вариант" value="">

                                    </div>
                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="self_answer" @if($post->self_answer) checked @endif value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                        Свой вариант ответа (включить в опрос)
                                    </label>
                                </div>
                                @if($post->self_answer)

                                    <h2>Варианты ответов пользователей</h2>
                                    <table id="table_list" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 5%">
                                                ID User
                                            </th>
                                            <th style="width: 5%">
                                               Логин
                                            </th>
                                            <th style="width: 5%">
                                                E-mail
                                            </th>
                                            <th>
                                                Свой вариант ответа
                                            </th>

                                            <th>
                                                Дата ответа
                                            </th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($post->voproses_muself as $variant)
                                            <tr>
                                                <td>
                                                    {{ $variant->id }}
                                                </td>
                                                <td>
                                                    {{ $variant->user->login }}
                                                </td>
                                                <td>
                                                    {{ $variant->user->email }}
                                                </td>
                                                <td>
                                                    {{ $variant->answer }}
                                                </td>

                                                <td>
                                                    {{date('Y.m.d H:i', strtotime($variant->created_at))}}
                                                </td>




                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>



                                    @endif


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
