@extends('layouts.admin_layout')

@section('title', 'Редактировать фотоконкурс')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать банер</h1>
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
                        <form action="{{ route('baner.update', $baner['id']) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название банера</label>
                                    <input type="text" value="{{ $baner['comment'] }}" name="comment" class="form-control"
                                           id="title" placeholder="Введите SEO Title статьи" required>
                                </div>
                                <div class="form-group">
                                    <label for="h1">Ccылка с банера</label>
                                    <input type="text" value="{{ $baner['url'] }}" name="url" class="form-control"
                                           id="h1" placeholder="Введите название фотоконкурса" required>
                                </div>


                                <div class="icheck-primary d-inline">

                                    <input type="checkbox" name="status" @if($baner->status) checked @endif value="1"
                                           id="checkboxSuccess">
                                    <label for="checkboxSuccess">
                                       Показ банера
                                    </label>
                                </div>


                                <div class="form-group">
                                    <label for="feature_image">Изображение для банера</label>
                                    <img src="@if(file_exists(storage_path('app/public/baners/'.$baner['baner'])))
                                    {{asset('public/storage/baners/'.$baner['baner'])}}
                                    @endif" alt="" class="img-uploaded"
                                         style="display: block; width: 300px">
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
