@extends('layouts.admin_layout')

@section('title', 'Редактирование категории бизнеса')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование категории: {{ $category['title'] }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('categorii-biznesa.index') }}">Все категории</a>
            @if (Session::has('error'))
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{Session::get('error')}}</h4>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
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
                        <form action="{{ route('categorii-biznesa.update', $category['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SEO Title</label>
                                    <input type="text" value="{{ $category['title'] }}" name="title" class="form-control"
                                        id="exampleInputEmail1" placeholder="Введите Title категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Заголовок H1</label>
                                    <input type="text" value="@if($category['h1']){{$category['h1']}}@else{{session('old.h1')}}@endif" name="h1" class="form-control"
                                           id="exampleInputEmail1" placeholder="Введите Заголовок категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SEO Description</label>
                                    <input type="text" value="{{ $category['description'] }}" name="description" class="form-control"
                                           id="exampleInputEmail1" placeholder="SEO описание">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Алиас</label>
                                    <input type="text" value="{{ $category['alias'] }}" name="alias" class="form-control"
                                           id="exampleInputEmail1" placeholder="Введите алиас категории" required>
                                </div>

                                <div class="form-group">
                                    <label>Выбор цвета рубрики:</label>
                                    <input type="text" name="color" style="background-color:{{ $category['color'] }};" value="{{ $category['color'] }}"  class="form-control my-colorpicker1">
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
