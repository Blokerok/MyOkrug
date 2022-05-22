@extends('layouts.admin_layout')

@section('title', 'Все страницы')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все второстепенные страницы</h1>
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
                            Название cтраницы
                        </th>

                        <th>
                            Дата добавления
                        </th>

                        <th style="width: 20%">
                        </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pages as $page)
                            <tr>
                                <td>
                                    {{ $page['id'] }}
                                </td>
                                <td>
                                    <a href="{{ route('page.edit', $page['id']) }}">{{ $page['title'] }}</a>
                                </td>

                                <td>
                                    {{date('Y.m.d H:i', strtotime($page->created_at))}}
                                </td>


                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('page.edit', $page['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <form action="{{ route('page.destroy', $page['id']) }}" method="POST"
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
