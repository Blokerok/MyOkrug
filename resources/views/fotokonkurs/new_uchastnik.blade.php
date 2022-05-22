@extends('layouts.app_face')

@section('title','Принять участие в конкурсе')
@section('description','Принять участие в конкурсе')

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / <a href="{{route('AllFotokonkurs')}}">Фотоконкурсы</a>
                / Принять участие в конкурсе
            </div>
            <h1>Отправить заявку на участие в фотоконкурсе</h1>
            <br/>
            <section class="content-box content-box--full content-box--blue-dark">
                <form class="reg-form forms forms--blue-dark" method="POST" action="{{route('creat_uchastnik')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="konkurs_id" value="{{$konkurs->id}}">
                    <input type="hidden" name="alias" value="{{$konkurs->alias}}">
                    <div class="feedback-form forms forms--blue-dark">
                        <div class="forms__field">
                            <label>ФИО/имя участника (приславшего)</label>
                            <div class="forms__inp">
                                <input id="fio" type="text" class="form-control @error('fio')is-invalid @enderror"
                                       name="fio" value="{{session('old.fio')}}">
                                @error('fio')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="forms__field">
                            <label>Электронная почта</label>
                            <div class="forms__inp">
                                <input id="email" type="text" class="form-control @error('email')is-invalid @enderror"
                                       name="email" value="{{session('old.email')}}">
                                @error('email')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="forms__field">
                            <label>Телефон</label>
                            <div class="forms__inp">
                                <input id="phone" type="text" class="form-control @error('phone')is-invalid @enderror"
                                       name="phone" value="{{session('old.phone')}}">
                                @error('phone')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="forms__field">
                            <label>Придумайте название для своего объекта</label>
                            <div class="forms__inp">
                                <input id="title" type="text" class="form-control @error('title')is-invalid @enderror"
                                       name="title" value="{{session('old.title')}}">
                                @error('title')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        @if ($konkurs->category_need)
                        <div class="forms__field">
                            <label>Категория</label>
                            <select name="category_name">
                                <option selected value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{$category}}">{{$category}}</option>

                                @endforeach
                            </select>

                        </div>
                        @endif

                        <div class="forms__field">
                            <div class="input-file">
                                <label>Главное изображение для участника конкурса</label>
                                <span class="input-file__field"></span>
                                <span class="input-file__button">Обзор</span>
                                <input id="post_image" type="file"
                                       class="form-control @error('post_image')is-invalid @enderror" name="post_image"
                                       value="">
                                <img
                                    src="@if(file_exists(storage_path('app/public/fotokonkurs_image/'.session('old.img'))))
                                    {{asset('public/storage/fotokonkurs_image/'.session('old.img'))}}@endif" alt=""
                                    style="display: block; width: 150px">
                                @error('post_image')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                @if (session('error_img'))
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ session('error_img') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="forms__field">
                            <div class="input-file">
                                <label>Добавьте фотографии для участия в конкурсе (до 10 шт.)</label>
                                <span class="input-file__field"></span>
                                <span class="input-file__button">Обзор</span>
                                <input id="post_images" type="file" class="" name="post_images[]" value="">
                                @error('post_images.*')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                                @if (session('error_img2'))
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ session('error_img2') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div id="dop_foto">

                        </div>

                        <div class="forms__field">
                            <label></label>
                            <button type="button" class="button add_foto">Добавить еще фото</button>
                        </div>

                            <div class="forms__field">
                                <label>Добавьте описание вашей Фотоистории</label>
                                <div class="forms__inp">
                                    <textarea id="text" type="text"
                                              class="form-control @error('text')is-invalid @enderror"
                                              name="text">{{session('old.text')}}</textarea>
                                    @error('text')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="forms__field check">
                                <input id="soglasie" type="checkbox" name="soglasie" required="">
                                <label for="soglasie">Согласие на обработку персональных данных в соответствии с <a
                                        href="https://xn--c1aldgkbpy.xn--p1ai/usloviya-fotokonkursa-obychnaya-stranicza-wp/"
                                        target="_blank">Правилами Конкурса</a></label>
                            </div>

                            <div class="forms__field check">
                                <input id="soglasie" type="checkbox" name="soglasie">
                                <label for="soglasie">Разрешение на использование фото ребенка (при
                                    необходимости)</label>
                            </div>

                            <div class="forms__field">
                                <label></label>
                                <button type="submit" class="button">Отправить</button>
                            </div>
                        </div>
                </form>

            </section>

            <div class="back_url"><a href="{{route('LinkKonkurs',[$konkurs->alias])}}">Вернуться к фотоконкурсу</a>
            </div>


        </div>

        @include('layouts.right_block')
    </div>

@endsection
