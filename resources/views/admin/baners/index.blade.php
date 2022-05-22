@extends('layouts.admin_layout')

@section('title', 'Банеры главной страницы')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Банеры главной страницы</h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
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
            <div class="card">
                <div class="card-body">

                    <table id="table_list_baners" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">
                                ID
                            </th>
                            <th>
                                Название
                            </th>
                            <th>
                                Статус банера
                            </th>

                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($baners as $baner)
                            <tr>
                                <td>
                                    {{ $baner['id'] }}
                                </td>
                                <td>
                                    <a href="{{ route('baner.edit', $baner['id']) }}">{{ $baner['comment'] }}</a>
                                </td>



                                <td>
                                    @if($baner['status'])
                                        <strong>Показывается</strong>
                                    @else
                                        Не показывается
                                    @endif
                                </td>


                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('baner.edit', $baner['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
