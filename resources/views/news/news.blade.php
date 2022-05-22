@extends('layouts.app_face')

@section('title')
    Новости @if(isset($rubrica)) рубрики {{$rubrica->title}}@endif
@endsection

@section('description')
    Новости @if(isset($rubrica)) рубрики {{$rubrica->title}}@endif
@endsection


@section('content')
    <div class="page-wrap">
        <div class="page-content">

            <div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / @if(isset($rubrica))<a href="{{route('AllNews')}}">Новости</a>@else Новости @endif  @if(isset($rubrica)) / {{$rubrica->h1}}@endif</div>

            <h1>Новости @if(isset($rubrica)) рубрики {{$rubrica->title}}@endif</h1>

            <div class="section-outer">
                <div class="row">
                    @if(count($news))
                        @foreach ($news as $new)
                            <div class="col-md-4">
                                <a href="{{route('LinkNew',[(isset($rubrica) ? $rubrica->alias:$new->category['alias']),$new->alias])}}" class="news-card">
                                    <figure class="news-card__thumb"><img src="@if($new->img){{asset('public/storage/news_image/tumb/tumb-'.$new->img)}}@else{{asset('public/uploads/news-03.jpg')}}@endif" alt=""/></figure>
                                </a>
                                    <div class="news-card__info">
                                        <div class="news-card__info-part" style="color:{{isset($rubrica) ? $rubrica->color:$new->category['color']}};"><a href="{{route('LinkRubricNews',[isset($rubrica) ? $rubrica->alias:$new->category['alias']])}}">{{ $new->category['h1'] }}</a></div>
                                        <div class="news-card__info-date" style="color:{{isset($rubrica) ? $rubrica->color:$new->category['color']}};">{{date('d.m.Y H:i', strtotime($new->created_at))}}</div>
                                    </div>
                                    <div class="news-card__title">
                                        <a href="{{route('LinkNew',[(isset($rubrica) ? $rubrica->alias:$new->category['alias']),$new->alias])}}">{{ $new->h1 }}</a>
                                    </div>

                            </div>
                        @endforeach
                            @else
                                <p>На портале пока нет новостей.</p>
                            @endif
                </div>
            </div>

        </div>
       @include('layouts.right_block')
    </div>

@endsection
