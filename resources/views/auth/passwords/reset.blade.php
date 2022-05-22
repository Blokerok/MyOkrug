
@extends('layouts.app_face')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">{{ __('Reset Password') }}</h1>

            </div>



            <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="forms__field">
                    <label>E-Mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email"/>
                    @error('email')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="forms__field">
                    <label>Пароль</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"/>
                    @error('password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="forms__field">
                    <label>Подтверждение пароля</label>
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password"/>

                </div>


                <div class="reg-form__action">
                    <button type="submit" class="button">   {{ __('Reset Password') }}</button>
                </div>

            </form>


        </section>

    </div>
@endsection
