@extends('layouts.admin_layout')

@section('title', 'Все озеленения')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все озеленения</h1>
                    <a href="{{route('ozelenenie.create')}}" class="btn btn-primary">Добавить озеленение</a>
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
                                Описание
                            </th>
                            <th>
                                Категория
                            </th>

                            <th>
                                Дата добавления
                            </th>

                            <th>
                               Результат "Да"
                            </th>

                            <th>
                             Результат "Нет"
                            </th>

                            <th>
                                Модерация
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($records as $post)
                            <tr>
                                <td>
                                    {{ $post['id'] }}
                                </td>
                                <td>
                                    <a href="{{ route('ozelenenie.edit', $post['id']) }}">{{ $post['name_green'] }}</a>
                                </td>
                                <td>
                                    {!!   $post['info'] !!}
                                </td>
                                <td>
                                    {{$post->category['title']}}
                                </td>
                                <td>
                                    {{date('Y.m.d H:i', strtotime($post->created_at->setTimezone('Europe/Moscow')))}}
                                </td>

                                <td>
                                    {{$post->count_yes()}}
                                </td>
                                <td>
                                    {{$post->count_no()}}
                                </td>

                                <td>  @if($post['moder'])
                                        <i class="fas fa-check"></i>
                                    @endif
                                </td>

                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('ozelenenie.edit', $post['id']) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <form action="{{ route('ozelenenie.destroy', $post['id']) }}"
                                          method="POST"
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
