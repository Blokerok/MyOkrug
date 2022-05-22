@extends('layouts.app_face')

@section('title')
    Отсутствие прав на эту страницу
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">Ошибка отсутствия прав</h1>

            </div>

            <div class="card-body">

                <p>403 | У Вас недостаточно прав для посещения этой страницы нужно иметь соответсвующие права для этого раздела.</p>


            </div>

        </section>

    </div>
@endsection
