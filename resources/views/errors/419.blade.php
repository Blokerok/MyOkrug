@extends('layouts.app_face')

@section('title')
    Cтраница устарела
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">Ошибка сеанса</h1>

            </div>

            <div class="card-body">

                <p>Сеанс на странице устарел, начните с <a href="{{url('/')}}">Главной страницы</a>.</p>

            </div>




        </section>

    </div>
@endsection
