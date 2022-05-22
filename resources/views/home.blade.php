@extends('layouts.app_face')

@section('title')
    Уведомления
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">Уведомления</h1>

            </div>

            <div class="card-body">
                @if (session('status') && !$active)
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}<br />

                    </div>

                @endif

                @if($active)
                    {{ __('You are logged in!') }}
                @elseif(!session('status'))
                        <p>Вы не активировали свой аккаунт, зайдите в свою почту {{Auth::user()->email}} и перейдите по активационной ссылке</p>
                        <a class="button"  href="{{ route('verification.resend') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('resend_activ_link').submit();">
                            Повторная отправка ссылки
                        </a>

                @endif
            </div>




        </section>

    </div>
@endsection



<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($active)
                    {{ __('You are logged in!') }}
                        @else
                     Вы не активировали свой аккаунт, перейдите в почту и перейдите по активационной ссылке
                            <a href="{{route('verification.send')}}">Повторная отправка ссылки</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div-->

