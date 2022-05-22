@extends('layouts.app_face')

@section('title')
   Личный кабинет пользователя
@endsection

@section('content')
<div class="page-wrap page-wrap--full">

    <section class="content-box content-box--full content-box--blue-dark">
        <h1 class="content-box__title">Личный кабинет пользователя</h1>

        <div class="user-offiсe">
            <aside class="user-offiсe__side">
                <div class="user-side">
                    <figure class="user-side__ava">
                        <a href="{{route('homeCabinet')}}"><img src="@if(Auth::user()->avatar) {{asset('public/storage/avatars/'.Auth::user()->id.'/'.Auth::user()->avatar)}} @else./public/images/avatar.png @endif" alt="" /></a>
                        <div class="user-side__ava-action"><a class="fb"  href="#avatar">@if(Auth::user()->avatar)Заменить аватар@elseДобавить аватар@endif</a></div>
                        @if(Auth::user()->avatar)<div class="user-side__ava-action"><a  href="{{ route('delete_avatar') }}">Удалить аватар</a></div>@endif
                    </figure>

                    <div class="user-side__nav">
                        <nav class="user-nav">
                            <div class="user-nav__group">
                                <div class="user-nav__item"><a href="#" class="user-nav__link user-nav__link--orange">Мои данные</a></div>
                            </div>
                            <div class="user-nav__group">
                                <div class="user-nav__item"><a href="#" class="user-nav__link">Мои инициативы</a></div>
                                <div class="user-nav__item"><a href="#" class="user-nav__link">Мои записи</a></div>
                                <div class="user-nav__item"><a href="#" class="user-nav__link">Мой рейтинг</a></div>
                                <div class="user-nav__item"><a href="#" class="user-nav__link">Мои закладки</a></div>
                            </div>
                            <div class="user-nav__group">
                                <div class="user-nav__item"><a href="#" onClick="event.preventDefault();
                                                               document.getElementById('send_data_user').submit();" class="user-nav__link user-nav__link--orange">Изменить данные</a></div>
                                <div class="user-nav__item">

                                    <a class="user-nav__link user-nav__link--red" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>

                            </div>
                        </nav>
                    </div>
                </div>
            </aside>
            <div class="user-offiсe__content">

                @if (session('messege'))
                    <div class="alert alert-success" role="alert">
                        {{ session('messege') }}
                    </div>
                @endif
                    @if (session('error_img'))
                        <div class="invalid-feedback" role="alert">

                            {{ session('error_img') }}
                        </div>
                    @endif
                    @error('avatar')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror

                    @error('tema')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    @error('text')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    @error('file')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror


                    <form  method="POST" id="send_data_user" action="{{ route('update_data_user') }}" enctype="multipart/form-data">
                        @csrf
                <div class="uo-forms forms">
                    <div class="uo-forms__group">
                        <div class="forms__field">
                            <label>Логин</label>
                            <input name="login" type="text" value="{{Auth::user()->login}}"/>
                            @error('login')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="forms__field">
                            <label>Имя</label>
                            <input type="text" name="name" value="{{Auth::user()->name}}" />
                            @error('name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="forms__field">
                            <label>Фамилия</label>
                            <input type="text" name="last_name" value="{{Auth::user()->last_name}}" />
                        </div>
                        <div class="forms__field">
                            <label>Дата рождения</label>
                            <input name="date_b" type="text" autocomplete="off" class="calendar" value="@if(Auth::user()->date_b){{date('d.m.Y', strtotime(Auth::user()->date_b))}}@endif" />
                        </div>
                        <div class="forms__field">
                            <label>Email</label>
                            <input type="text" name="email" value="{{Auth::user()->email}}" />
                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!--div class="uo-forms__group">
                        <div class="forms__field">
                            <label>Мои интересы ?</label>
                        </div>

                        <div class="checkbox-list">
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Экология</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Культура</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Архитектура</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Городская среда</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Недвижимость</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Спорт</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Здоровье</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Дети</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Туризм</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Дороги</span>
                                </label>
                            </div>
                            <div class="checkbox-list__item">
                                <label class="check-button">
                                    <input type="checkbox" value="" />
                                    <span>Досуг</span>
                                </label>
                            </div>
                        </div>
                    </div-->

                    <div class="uo-forms__group">
                        <div class="forms__field forms__field--wrap">
                            <label>Район проживания (локация)</label>
                            <select name="id_district" class="@error('id_district') is-invalid @enderror">
                                <option selected disabled hidden>Выбрать из списка</option>
                                @foreach($districts as $district)
                                    <option value="{{$district->id_district}}" @if(Auth::user()->id_district==$district->id_district) selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                    </form>
            </div>
        </div>
    </section>

    <section class="content-box content-box--full content-box--blue-dark">
        <h2 class="content-box__title">Отправить сообщение Администратору портала</h2>
        <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('send_form') }}" enctype="multipart/form-data">
            @csrf
        <div class="feedback-form forms forms--blue-dark">
            <div class="forms__field">
                <label>Тема</label>
                <input id="tema" type="text" class="@error('tema') is-invalid @enderror" name="tema" value="{{ old('tema') }}"/>
                @error('tema')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="forms__field">
                <label>Текст сообщения</label>
                <textarea id="text" type="text" class="@error('text') is-invalid @enderror" name="text">{{ old('text') }}</textarea>
                @error('text')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="forms__field">
                <div class="input-file">
                    <span class="input-file__field"></span>
                    <span class="input-file__button">Обзор</span>
                    <input id="file" type="file" class="@error('file') is-invalid @enderror" name="file" value="{{ old('file') }}"/>
                    @error('file')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="forms__field">
                <label></label>
                <button type="submit" class="button">Отправить</button>
            </div>
        </div>
        </form>

    </section>
    <div id="avatar" style="width: 33%;text-align: center;display:none">
        <h2>Ваш аватар</h2>
        <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('save_avatar') }}" enctype="multipart/form-data">
            @csrf
            <div class="feedback-form forms forms--blue-dark">

                <div class="forms__field">
                    <div class="input-file">
                        <span class="input-file__field"></span>
                        <span class="input-file__button">Обзор</span>
                        <input id="avatar" type="file" class="@error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}"/>
                        @error('avatar')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="forms__field">
                    <label></label>
                    <button type="submit" class="button">Сохранить аватар</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


