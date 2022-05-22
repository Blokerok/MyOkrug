@extends('layouts.app_face')

@section('title')
    Авторизация
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">{{ __('Login') }}</h1>

            </div>


            <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="forms__field">
                    <label>E-Mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email"/>
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

                <div class="reg-form__confirm">
                    <label class="check-button">

                        <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>
                            {{ __('Remember Me') }}
                        </span>

                    </label>
                </div>


                <div class="reg-form__captcha">
                    <img src="./uploads/recaptcha.jpg" alt="" />
                </div>

                @if (Route::has('password.request'))
                    <a  href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

                <div class="reg-form__action">
                    <button type="submit" class="button"> {{ __('Login') }}</button>
                </div>

            </form>


    </section>

  </div>
@endsection

