@extends('layouts.admin_layout')

@section('title', 'Все все фотоконкурсы')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все фотоконкурсы</h1>
                    <a href="{{ route('fotokonkurs.create') }}" class="btn btn-primary">Добавить фотоконкурс</a>
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

                    <table id="table_list" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">
                                ID
                            </th>
                            <th>
                                Название
                            </th>
                            <th>
                                Дата добавления
                            </th>
                            <th>
                                Конкурс завершен
                            </th>

                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    {{ $post['id'] }}
                                </td>
                                <td>
                                    <a href="{{ route('fotokonkurs.edit', $post['id']) }}">{{ $post['title'] }}</a>
                                </td>

                                <td>
                                    {{date('Y.m.d H:i', strtotime($post->created_at))}}
                                </td>

                                <td>
                                    @if($post['stop'])
                                        <i class="fas fa-check"></i>
                                    @endif
                                </td>


                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('fotokonkurs.edit', $post['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <form action="{{ route('fotokonkurs.destroy', $post['id']) }}" method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash">
                                            </i>
                                            Удалить
                                        </button>
                                    </form>
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
