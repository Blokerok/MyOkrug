@extends('layouts.admin_layout')

@section('title', 'Все пользователи')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все пользователи</h1>

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
        <form action="{{ route('del_users') }}" method="POST">
            @csrf

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-danger btn-sm delete-btn" style="margin-bottom: 20px;">
                        <i class="fas fa-trash">
                        </i>
                        Удалить выбранные
                    </button>

                    <table id="table_list" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">
                                ID
                            </th>
                            <th>
                                Логин
                            </th>
                            <th>
                               Имя
                            </th>
                            <th>
                                E-mail
                            </th>
                            <th>
                                Администратор
                            </th>
                            <th>
                                Активация
                            </th>
                            <th>
                                Дата добавления
                            </th>

                            <th style="width: 20%">
                                Выбрать все для удаления   <input type="checkbox"  value="1"  id="all_dell">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{ $user['id'] }}
                                </td>
                                <td>
                                   {{ $user['login'] }}
                                </td>
                                <td>
                                    {{ $user['name'] }}
                                </td>
                                <td>
                                    {{ $user['email'] }}
                                </td>
                                <td>
                                    @if ($user->HasRole('admin'))
                                        <i class="fas fa-check"></i>
                                    @endif
                                </td>

                                <td>
                                    @if($user['email_verified_at']){{date('Y.m.d H:i', strtotime($user['email_verified_at']))}}@endif
                                </td>

                                <td>
                                  {{date('Y.m.d H:i', strtotime($user['created_at']))}}
                                </td>

                                <td>



                                        <input class="deluser" type="checkbox" name="delete[]" value="{{$user['id']}}"
                                               id="checkboxSuccess{{$user['id']}}">


                                </td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                        <i class="fas fa-trash">
                        </i>
                        Удалить выбранные
                    </button>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        </form>
    </section>
    <!-- /.content -->
@endsection
