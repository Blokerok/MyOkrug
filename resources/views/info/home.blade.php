@extends('layouts.app_face')

@section('title')
    Инфо
@endsection

@section('content')
    <div class="page-wrap">
        <div class="page-content">
						
						<div class="page-header">
								<div class="page-header__wrap">
										<div class="breadcrumbs"><a href="{{url('/')}}">Главная</a> / ИнфоОкруг</div>
										<h1>ИнфоОкруг</h1>
								</div>
								<div class="page-header__icon">
										<img src="./public/images/info-okrug.png" alt="ИнфоОкруг">
								</div>
						</div>

            @if ($banners->count()>0)
                <div class="promo-box">
                    <div class="promo-slider js-promo-slider">
                        @foreach ($banners as $baner)
                            <div class="promo-slider__item">
                                <a href="{{ $baner['url'] }}"
                                   class="promo-slide"
                                   style="background-image: url('{{asset('public/storage/baners/'.$baner['baner'])}}')">
                                    <div class="promo-slide__wrap">
                                        <div class="promo-slide__title">{{ $baner['name'] }}</div>
                                        <div class="promo-slide__info">
                                            <div class="promo-slide__info-part promo-slide__info-part--blue">{{ $baner['comment'] }}
                                            </div>
                                            <div class="promo-slide__info-date">{{ $baner['date'] }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            <div class="inits-card__descr">
                <div class="partner-list">
                    <div class="partner-list__item">
                        <div class="partner-list-card">
                            <div class="partner-list-card__info">
                                <div class="partner-list-card__info-logo"><img
                                            src="./public/uploads/partner-logo-02.jpg" alt=""></div>
                                <div class="partner-list-card__info-title">Глава Раменского городского округа Виктор
                                    Неволин
                                </div>
                            </div>
                            <div class="partner-list-card__contacts">
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://t.me/viktornevolin"><img
                                                src="./public/images/social-button-telegram.svg" alt=""></a></div>
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://vk.com/viktornevolin"><img
                                                src="./public/images/social-button-vk.svg" alt=""></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="partner-list__item">
                        <div class="partner-list-card">
                            <div class="partner-list-card__info">
                                <div class="partner-list-card__info-logo"><img
                                            src="./public/uploads/partner-logo-01.jpg" alt=""></div>
                                <div class="partner-list-card__info-title">Администрация Раменского городского округа
                                </div>
                            </div>
                            <div class="partner-list-card__contacts">
                                <div class="partner-list-card__contacts-link"><a href="https://www.ramenskoye.ru">ramenskoye.ru</a>
                                </div>
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://ok.ru/administraciya.ramenskoye"><img
                                                src="./public/images/social-button-ok.svg" alt=""></a></div>
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://t.me/ramenskoye_official"><img
                                                src="./public/images/social-button-telegram.svg" alt=""></a></div>
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://vk.com/ramenskoyeregion"><img
                                                src="./public/images/social-button-vk.svg" alt=""></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="partner-list__item">
                        <div class="partner-list-card">
                            <div class="partner-list-card__info">
                                <div class="partner-list-card__info-logo"><img
                                            src="./public/uploads/partner-logo-03.jpg" alt=""></div>
                                <div class="partner-list-card__info-title">Центр управления регионом</div>
                            </div>
                            <div class="partner-list-card__contacts">
                                <div class="partner-list-card__contacts-link"><a href="tel:8 (496) 473 57 03">Горячая
                                        линия Главы: 8 (496) 473 57 03</a></div>
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://ok.ru/cur.ramenskoe"><img
                                                src="./public/images/social-button-ok.svg" alt=""></a></div>
                                <div class="partner-list-card__contacts-social"><a
                                            href="https://vk.com/cur_ramenskoe"><img
                                                src="./public/images/social-button-vk.svg" alt=""></a></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="partner-group">
                    <div class="partner-group__item">
                        <div class="partner-group-box">
                            @foreach($rubrics as $rubric)
                                <div class="partner-group-box__title js-next-toggle">
                                    {{$rubric->title}}
                                </div>
                                <div class="partner-group-box__list" style="display: none;">
                                    <div class="partner-list">
                                        @foreach($rubric->info as $info)
                                            <div class="partner-list__item">
                                                <div class="partner-list-card">
                                                    <div class="partner-list-card__info">
                                                        @if (!empty($info->img))
                                                            <div class="partner-list-card__info-logo"><img
                                                                        src="{{asset('public/storage/info_image/'.$info->img)}}"
                                                                        alt=""></div>
                                                        @endif
                                                        <div class="partner-list-card__info-title">{{$info->title}}</div>
                                                    </div>
                                                    <div class="partner-list-card__contacts">
                                                        @if (!empty($info->phone))
                                                            <div class="partner-list-card__contacts-link"><a
                                                                        href="tel:>{{$info->phone}}">{{$info->phone}}</a>
                                                            </div>
                                                        @endif
                                                        @if (!empty($info->sait))
                                                            <div class="partner-list-card__contacts-link"><a
                                                                        href="{{$info->sait}}">{{$info->sait}}</a>
                                                            </div>
                                                        @endif
                                                        @if (!empty($info->social_ok))
                                                            <div class="partner-list-card__contacts-social"><a
                                                                        href="{{$info->social_ok}}"><img
                                                                        src="./public/images/social-button-ok.svg"
                                                                        alt=""></a>
                                                            </div>
                                                        @endif
                                                        @if (!empty($info->social_telegram))
                                                            <div class="partner-list-card__contacts-social"><a
                                                                        href="{{$info->social_telegram}}"><img
                                                                            src="./public/images/social-button-telegram.svg"
                                                                            alt=""></a>
                                                            </div>
                                                        @endif
                                                        @if (!empty($info->social_vk))
                                                            <div class="partner-list-card__contacts-social"><a
                                                                        href="{{$info->social_vk}}"><img
                                                                            src="./public/images/social-button-vk.svg"
                                                                            alt=""></a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
@endsection