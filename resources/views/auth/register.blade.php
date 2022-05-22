@extends('layouts.app_face')

@section('title')
   Регистрация пользователя
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">Регистрация пользователя</h1>
                <div class="content-box__subtitle">Все поля обязательны для заполнения</div>
            </div>


            <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="forms__field">
                    <label>Логин</label>
                    <input id="login" type="text" class="form-control @error('login')is-invalid @enderror" name="login" value="{{ old('login') }}"  autocomplete="login" autofocus/>
                    @error('login')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="forms__field">
                    <label>Имя</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus/>
                    @error('name')
                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                    @enderror
                </div>
                <div class="forms__field">
                    <label>Фамилия</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="last_name" autofocus/>
                    @error('last_name')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
                <div class="forms__field">
                    <label>Email</label>
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
                    <div class="forms__field">
                        <label>Подтверждение пароля</label>
                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password"/>
                        @error('password_confirmation')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                <div class="forms__field forms__field--wrap">
                    <label>Район проживания (локация)</label>
                    <select name="id_district" class="@error('id_district') is-invalid @enderror">
                        <option selected disabled hidden>Выбрать из списка</option>
                        @foreach($districts as $district)
                        <option value="{{$district->id_district}}">{{$district->name}}</option>
                        @endforeach
                    </select>
                        @error('id_district')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                </div>

                <div class="reg-form__confirm">
                    <label class="check-button">
                        <input name="personal" type="checkbox" value="1" @if(old('personal')) checked @endif/>
                        <span class="@error('personal') is-invalid @enderror">
									Подтверждаю, что отправляя данную форму на регистрацию
									на портале МойОкруг.рф, я даю согласие на обработку
									и хранение своих персональных данных
								</span>
                    </label>
                </div>

                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <div class="reg-form__action">
                    <button type="submit" class="button">Зарегистрироваться</button>
                </div>

            </form>

        </section>
    </div>
@endsection

