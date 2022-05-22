@extends('layouts.app_face')

@section('title',$page->title)
@section('description',$page->description)

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / {{$page->h1}}</div>
            <h1>{{$page->h1}}</h1>

            @if (session('messege'))
                <div class="alert alert-success" role="alert">
                    {{ session('messege') }}
                </div>
            @endif

            <div class="inits-card__descr">
                @if($page->img)
                    <figure class="img_news_1"><a href="{{asset('public/storage/page_image/'.$page->img)}}"
                                                  class="fb"><img
                                src="{{asset('public/storage/page_image/tumb/tumb-'.$page->img)}}"/></a>
                    </figure>
                @endif


                {!!$page->text!!}
                {!!$page->scrip!!}

                @if($page->id==14)
                    @include('oprosu')
                @endif

            </div>
            <div class="clear"></div>

            <div class="inits-card__bottom-stat">
                <div class="objs-stat">
                    <div class="objs-stat__item">{{ $page->visits }} просмотров</div>

                </div>
            </div>
            @if(count($page->images))
                <div class="gallery">
                    @foreach ($page->images as $img)
                        <div class="item"><a data-fancybox="gallery"
                                             href="{{asset('public/storage/page_image/'.$img->img)}}" class="fb"><img
                                    src="{{asset('public/storage/page_image/tumb/tumb-'.$img->img)}}"/></a></div>
                    @endforeach
                </div>
            @endif

            @if (Auth::check())
                @if (Auth::user()->email_verified_at!==NULL && $page->id==9)

                    <section class="content-box content-box--full content-box--blue-dark">
                        <h2 class="content-box__title">Отправить обращение Главе округа</h2>
                        <form class="reg-form forms forms--blue-dark" method="POST"
                              action="{{ route('send_for_glava') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="feedback-form forms forms--blue-dark">
                                <div class="forms__field">
                                    <label>Тема</label>
                                    <input id="tema" type="text" class="@error('tema') is-invalid @enderror" name="tema"
                                           value="{{ old('tema') }}"/>
                                    @error('tema')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="forms__field">
                                    <label>Телефон для обратной связи</label>
                                    <input id="tema" type="text" class="@error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}"/>
                                    @error('phone')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="forms__field">
                                    <label>Текст сообщения</label>
                                    <textarea id="text" type="text" class="@error('text') is-invalid @enderror"
                                              name="text">{{ old('text') }}</textarea>
                                    @error('text')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="forms__field">
                                    <label>Прикрепите фото(файл) при необходимости</label>
                                    <div class="input-file">
                                        <span class="input-file__field"></span>
                                        <span class="input-file__button">Обзор</span>
                                        <input id="file" type="file" class="@error('file') is-invalid @enderror"
                                               name="file" value="{{ old('file') }}"/>
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

                @endif
            @elseif($page->id==9)
                <section class="content-box content-box--full content-box--blue-dark">
                    <div class="inits-card__descr">
                        <p>Чтобы отправить обращение Главе округа пожалуйста <a href="{{route('register')}}">зарегистрируйтесь</a>
                            и <a href="{{route('login')}}">авторизуйтесь</a> на нашем портале.</p>
                    </div>
                </section>
            @endif


            <p class="back"><a href="{{url('/')}}">Вернуться на главную</a></p>


        </div>

        @include('layouts.right_block')
    </div>

@endsection
