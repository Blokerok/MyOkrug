
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

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('password.email') }}">
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


                <div class="reg-form__action">
                    <button type="submit" class="button">  {{ __('Send Password Reset Link') }}</button>
                </div>

            </form>


        </section>

    </div>
@endsection
