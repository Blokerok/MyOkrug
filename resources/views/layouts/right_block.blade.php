<aside class="page-side">

    <div class="side-box side-box--blue">
        <div class="side-box__header">
            <h3 class="side-box__title">Глава округа</h3>
            <div class="side-soc">
                <a href="https://www.instagram.com/viktornevolin/" class="side-soc__item" target="_blank"><img
                        src="{{ asset("public/images/soc-icon-inst.png")}}"
                        alt=""/></a>
                <a href="https://www.facebook.com/viktor.nevolin.9" class="side-soc__item" target="_blank"><img
                        src="{{ asset("public/images/soc-icon-fb.png")}}" alt=""/></a>
                <a href="https://vk.com/viktornevolin" class="side-soc__item" target="_blank"><img
                        src="{{ asset("public/images/soc-icon-vk.png")}}" alt=""/></a>
                <a href="https://ok.ru/profile/578423895788" class="side-soc__item" target="_blank"><img
                        src="{{ asset("public/images/soc-icon-youtube.png")}}"
                        alt=""/></a>
            </div>
        </div>
        <div class="side-box__wrap">
            <div class="side-intro">
                <div class="side-intro__photo"><a href="{{url('glava-okruga')}}"><img
                            src="{{ asset("https://xn--c1aldgkbpy.xn--p1ai/public/storage/page_image/page-glava-okruga-1639041791-9.jpg")}}" alt="Глава округа"/></a></div>
                <!--div class="side-intro__text">
                    Приветсвенное слово Главы об открытой власти и общественном портале.
                    Связующее звено между Властью и Жителями - это портал Мой Округ.
                </div-->
                <div class="side-intro__note">
                    <a href="{{url('glava-okruga')}}">Написать</a> на Горячую линию Главы
                </div>
            </div>
        </div>
    </div>

    <div class="side-box side-box--orange">
        <div class="side-box__header">
            <h3 class="side-box__title">ТОП-5 новостей</h3>
        </div>
        <div class="side-box__wrap">
            <div class="side-top-list">
                @if(count($top_news))
                    @foreach ($top_news as $new)
                        <div class="side-top-list__item">
                            <a href="{{route('LinkNew',[$new->category['alias'],$new->alias])}}" class="side-news-link">
                                {{$new->title}}
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>На портале нет новостей.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="side-box">
        <a href="{{route('AllMaterial')}}" class="side-banan">
            <img src="{{ asset("public/uploads/question-banan.jpg")}}" alt="Один вопрос"/>
        </a>
    </div>

    <!--div class="side-box side-box--red">
        <div class="side-box__header">
            <h3 class="side-box__title">Карта отключений ЖКХ</h3>
        </div>

        <div class="side-map">
            <img src="{{ asset("public/uploads/zkh-map.jpg")}}" alt=""/>
        </div>
    </div-->

    <div class="side-box">
        <a href="{{route('AllDvors')}}" class="side-banan-moi-dvor">
					<img src="/img/moydvor.jpg" border="0" />
        </a>
    </div>

    <!--div class="side-box side-box--green">
        <div class="side-box__header">
            <h3 class="side-box__title">Инициативы жителей</h3>
        </div>
        <div class="side-box__wrap">
            <div class="side-top-list side-top-list--middle">
                <div class="side-top-list__item">
                    <a href="#" class="side-initiative-link">Создание догпарка</a>
                </div>
                <div class="side-top-list__item">
                    <a href="#" class="side-initiative-link">Велосообщество</a>
                </div>
                <div class="side-top-list__item">
                    <a href="#" class="side-initiative-link">Памятник Свинке Пеги</a>
                </div>
                <div class="side-top-list__item">
                    <a href="#" class="side-initiative-link">Фотовыставки</a>
                </div>
                <div class="side-top-list__item">
                    <a href="#" class="side-initiative-link">Общественный WC</a>
                </div>
            </div>
        </div>
        <div class="side-box__bottom">
            <div class="side-box__bottom-action">
                <a href="#">Моя инициатива!</a>
            </div>
            <div class="side-box__bottom-more">
                <a href="#">Все инициативы</a>
            </div>
        </div>
    </div-->

    <!--div class="side-box">
        <a href="#" class="side-info-link">Полезные<br/> ссылки</a>
    </div-->

    <div class="side-box side-box--blue">
        <div class="side-box__header">
            <h3 class="side-box__title">Фотоконкурсы</h3>
        </div>
        <div class="side-box__wrap">
            <div class="side-gallery">
                @if(count($foto_kon_top3))
                    @foreach($foto_kon_top3 as $konkurs)
                        <a href="{{route('LinkKonkurs',[$konkurs->alias])}}" class="side-gallery__item">
                            <img src="{{asset('public/storage/fotokonkurs_image/'.$konkurs->img)}}" alt=""/>
                            <span>{{$konkurs->h1}}</span>
                        </a>
                    @endforeach
                @else
                    <p>Фотоконкурсы сейчас не проводятся.</p>
                @endif
            </div>
        </div>
        <div class="side-box__bottom">
            <div class="side-box__bottom-action">
                <a href="{{route('AllFotokonkurs')}}">Принять участие</a>
            </div>
            <div class="side-box__bottom-more"><a href="{{route('AllFotokonkurs')}}">Все фотоконкурсы</a></div>
        </div>
    </div>
</aside>
