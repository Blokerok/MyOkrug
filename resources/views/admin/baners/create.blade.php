@extends('layouts.admin_layout')

@section('title', 'Добавить баннер')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить баннер</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="{{ route('AllBaners') }}">Все банеры</a>
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
                        <form action="{{ route('baner.store') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название банера</label>
                                    <input type="text" value="" name="comment" class="form-control"
                                           id="title" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="title">Url</label>
                                    <input type="text" value="" name="url" class="form-control"
                                           id="title" placeholder="url" required>
                                </div>

                                <div class="form-group">
                                    <label for="title">Название банера для раздела инфо</label>
                                    <input type="text" value="" name="name" class="form-control"
                                           id="title" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="h1">Дата банера для раздела инфо</label>
                                    <input type="text" value="" name="date" class="form-control"
                                           id="h1" placeholder="" >
                                </div>


                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="status" value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                       Показ банера
                                    </label>
                                </div>

                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="for_info" value="1"
                                           id="checkboxSuccess1">
                                    <label for="checkboxSuccess1">
                                        Для раздела инфо
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="feature_image">Изображение для банера</label>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="baner">
                                        <label class="custom-file-label" for="image">Выберите изображение</label>
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
