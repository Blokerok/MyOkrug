@extends('layouts.app_face')

@section('title')
   тест файловой загрузки
@endsection

@section('content')
    <div class="page-wrap page-wrap--center">

        <section class="content-box content-box--blue-dark container-inner">
            <div class="content-box__header">
                <h1 class="content-box__title">Тест загрузки</h1>

            </div>

            @if (session('messege'))
                <div class="alert alert-success" role="alert">
                    {{ session('messege') }}
                </div>
            @endif

            <form class="reg-form forms forms--blue-dark" method="POST" action="{{ route('save_file') }}" enctype="multipart/form-data">
                @csrf

                <div class="feedback-form forms forms--blue-dark">
                    <label>Прикрепить файл</label>
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






                <div class="reg-form__action">
                    <button type="submit" class="button"> Отправить</button>
                </div>
              </div>
            </form>


        </section>

    </div>
@endsection
