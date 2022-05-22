@extends('layouts.app_face')

@section('title')
    "Моя история"
@endsection
@section('description','Моя история')

@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> /  "Моя история"</div>

            <h1>"Моя история"</h1>

            <div class="section-outer">
                <div class="row">
                    @if(count($materials))
                        @foreach ($materials as $new)
                            <div class="col-md-4">
                                <a href="{{route('LinkLudi',[$new->alias])}}" class="news-card">
                                    <figure class="news-card__thumb"><img src="@if($new->img){{asset('public/storage/moy_okrug_image/tumb/tumb-'.$new->img)}}@else{{asset('public/uploads/news-03.jpg')}}@endif" alt=""/></figure>
                                </a>
                                <div class="news-card__info">
                                    <div class="news-card__info-date">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                </div>
                                <div class="news-card__title">
                                    <a href="{{route('LinkLudi',[$new->alias])}}">{{ $new->h1 }}</a>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <p>На портале пока тут нет статей.</p>
                    @endif
                </div>
            </div>

        </div>
        @include('layouts.right_block')
    </div>

@endsection
