<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <title>@yield('title')@if($segment) : {{ config('app.name', 'Laravel') }}@endif</title>

    <!-- SITE STYLE -->
    <link rel="canonical" href="{{url()->current()}}" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset("public/fonts/geometria.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/css/style.css?ver=".rand(0,10000000))}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--link href="{{ asset("public/css/app.css")}}" rel="stylesheet" type="text/css" /-->


    <!-- PLUGINS -->

    <script src="{{ asset("public/libs/jquery/jquery-1.11.0.min.js")}}"></script>

    <!-- fancybox -->
    <link href="{{ asset("public/libs/fancybox/jquery.fancybox.min.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("public/libs/fancybox/jquery.fancybox.min.js")}}"></script>

    <!-- formstyler -->
    <link href="{{ asset("public/libs/formstyler/jquery.formstyler.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/libs/formstyler/jquery.formstyler.theme.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("public/libs/formstyler/jquery.formstyler.js")}}"></script>


    <link href="{{ asset("public/libs/slick/slick.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("public/libs/slick/slick.js")}}"></script>


    <!-- SITE SCRIPT -->

    <script type="text/javascript" src="{{ asset("public/libs/jquery.mask.js")}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset("public/js/common.js?ver=".rand(0,10000000))}}"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcNCUseAAAAAMIkpbei_ZCJIA45p4gshgViNM-z"></script>
    <script src="{{ asset("public/libs/sweetalert.js")}}"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6LcNCUseAAAAAMIkpbei_ZCJIA45p4gshgViNM-z', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                if(recaptchaResponse)
                recaptchaResponse.value = token;
            });
        });
    </script>


</head>

<body>
<div @if($segment)class="cbc inner_page" @else class="cbc"@endif>
    <header class="header">
        <div class="container">


            <div class="header__wrap">
                <div class="header__logo">
                    <div>
                        <a href="{{ url('/') }}" class="h-logo"><img src="{{ asset("public/images/logo.svg")}}" alt="????????????????.???? ???????????????????????? ???????????? ???????????????????? ????????????" /></a>
                        <a href="#" class="h-loc">???????? ??????????????</a>
                    </div>
                </div>
                <div class="header__slogan">
                    <div class="h-slogan">
                        <div class="h-slogan__info">????????????????.???? - ???????????????????????? ???????????? ???????????????????? ???????????????????? ????????????</div>
                        <div class="h-slogan__text"><span class="h-slogan__text-green">????????????</span> <span class="h-slogan__text-blue">??????????</span> <span class="h-slogan__text-orange">??????????????????????!</span></div>
                    </div>
                </div>

                <!--div class="header__specvers">
                    <a href="#">???????????? ?????? ????????????????????????</a>
                </div-->

                <div class="h-mob-buttons">
                    <span class="h-mob-search js-open-search"></span>
                    @guest<a href="{{ route('login') }}" class="h-mob-login"></a>@endguest
                </div>

                <span class="burger-btn header__burger js-toggle-nav"><span></span></span>
            </div>
            <div class="header__nav">
                <div class="main-nav">
                    <div class="main-nav__left">
                        <div class="main-nav__item">
                            <a href="#" class="main-nav__link{{ request()->segment(1)=='istoricheskaya-spravka' || request()->segment(1)=='moy-biznes' || request()->segment(1)=='moya-istoria'  ? ' active' : '' }}">?????? ??????????</a>

                            <div class="main-nav__subn mn-subn">
                                <div class="mn-subn__item"><a href="{{url('istoricheskaya-spravka')}}" class="mn-subn__link">???????????????????????? ??????????????</a></div>
                                <div class="mn-subn__item"><a href="{{route('AllLudi')}}" class="mn-subn__link">?????? ??????????????</a></div>
                                <div class="mn-subn__item"><a href="{{route('AllBiznes')}}" class="mn-subn__link">?????? ????????????</a></div>
                                <div class="mn-subn__item"><a href="#" class="mn-subn__link">??????????????????</a></div>
                                <div class="mn-subn__item"><a href="#" class="mn-subn__link">???????????????????? ?????????? ??????</a></div>
                            </div>

                        </div>
                        <div class="main-nav__item">
                            <a href="#" class="main-nav__link{{ request()->segment(1)=='moy-dvor' || request()->segment(1)=='itogi-2021-goda' || request()->segment(1)=='fotokonkursu'? ' active' : '' }}">?????? ??????????????</a>

                            <div class="main-nav__subn mn-subn">
                                <div class="mn-subn__item"><a href="#" class="mn-subn__link">????????????????????</a></div>
                                <div class="mn-subn__item"><a href="{{url('ozelenenie')}}" class="mn-subn__link">?????????????? ??????????</a></div>
                                <div class="mn-subn__item"><a href="{{route('AllDvors')}}" class="mn-subn__link">?????? ????????</a></div>
                                <div class="mn-subn__item"><a href="{{route('AllOpros')}}" class="mn-subn__link">????????????</a></div>
                                <div class="mn-subn__item"><a href="{{route('AllFotokonkurs')}}" class="mn-subn__link">????????????????????????</a></div>
                                <div class="mn-subn__item"><a href="#" class="mn-subn__link">??????????????????????????</a></div>
                            </div>
                        </div>
                        <div class="main-nav__item"><a href="#" class="main-nav__link">?????? ???? ????????????</a></div>
                        <div class="main-nav__item{{ request()->segment(1)=='odin-vopros' ? ' active' : '' }}"><a href="{{route('AllMaterial')}}" class="main-nav__link">???????? ????????????</a></div>
                        <div class="main-nav__item"><a href="{{url('info')}}" class="main-nav__link">??????????????????</a></div>
                        <div class="main-nav__item"><a href="#" class="main-nav__link">????????????</a></div>
                    </div>
                    <div class="main-nav__right">
                        @guest
                            <div class="main-nav__item"><a href="{{ route('login') }}" class="main-nav__link">????????</a></div>
                            <div class="main-nav__item"><a href="{{ route('register') }}" class="main-nav__link">??????????????????????</a></div>
                        @else
                            <div class="main-nav__item">
                                <a href="#" class="main-nav__link"> {{ Auth::user()->login}}</a>

                                <div class="main-nav__subn mn-subn">
                                    @if (Auth::user()->email_verified_at!==NULL)


                                            @if (Auth::user()->HasRole('admin'))
                                            <div class="mn-subn__item">
                                              <a href="{{route('homeAdmin')}}" class="mn-subn__link">??????????????</a>
                                            </div>
                                            <div class="mn-subn__item">
                                                <a href="{{route('homeCabinet')}}" class="mn-subn__link">??????????????</a>
                                            </div>
                                            @else
                                            <div class="mn-subn__item">
                                                <a href="{{route('homeCabinet')}}" class="mn-subn__link">??????????????</a>
                                            </div>
                                            @endif


                                    @else

                                        <div class="mn-subn__item"><a class="mn-subn__link" href="{{ route('verification.resend') }}"
                                                                      onclick="event.preventDefault();
                                                     document.getElementById('resend_activ_link').submit();">
                                                ?????????????????? ???????????? ???? ??????????????????
                                            </a>
                                        </div>
                                        <form id="resend_activ_link" method="POST" action="{{ route('verification.resend') }}">
                                            @csrf

                                        </form>

                                    @endif
                                    <div class="mn-subn__item"><a class="mn-subn__link" href="{{ route('logout') }}"
                                                                  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-nav__item">
                                <a class="main-nav__link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        @endguest
                        <div class="main-nav__item"><a href="{{url('o-proekte')}}" class="main-nav__link">?? ??????????????</a></div>
                    </div>
                </div>
            </div>

            <div class="header__bottom">
                <div class="header__credo">
                    <div class="h-credo">
                        <span class="h-credo__text h-credo__text--green">????????????????!</span>
                        <span class="h-credo__text h-credo__text--blue">???????? ??????????!</span>
                        <span class="h-credo__text h-credo__text--orange">??????????!</span>
                    </div>
                </div>
                <!--div class="header__search">
                    <div class="h-search">
                        <input type="text" value="" placeholder="?????? ???? ???????????? ???????????" class="h-search__field" />
                        <button class="h-search__send"></button>
                        <span class="h-search__close js-close-search"></span>
                    </div>
                </div-->
            </div>
        </div>
    </header>


    <div class="container">
            @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="f-logo">
                    <img src="{{ asset("public/images/logo.svg")}}" alt="" />
                    <span>{{ config('app.name', 'Laravel') }}</span>
                </div>

                <div class="f-nav">
                    <div class="f-nav__item"><a href="{{route('show_page','ob-okruge')}}" class="f-nav__link">?????? ??????????</a></div>
                    <div class="f-nav__item"><a href="#" class="f-nav__link">?????? ??????????????</a></div>
                    <div class="f-nav__item"><a href="{{route('AllMaterial')}}" class="f-nav__link">???????? ????????????</a></div>
                    <div class="f-nav__item"><a href="#" class="f-nav__link">???????????? ??????????????</a></div>
                    <div class="f-nav__item"><a href="#" class="f-nav__link">????????????</a></div>
                    <div class="f-nav__item"><a href="#" class="f-nav__link">?????? ???? ????????????</a></div>
                </div>

                <div class="f-soc">
                    <div class="f-soc__item"><a href="https://vk.com/moy_okrug" target="_blank"><img src="{{ asset("public/images/soc-icon-vk.png")}}" alt="" /></a></div>
                    <div class="f-soc__item"><a href="https://www.youtube.com/channel/UCtc2x8ZwIZQmuEI_z2YAH9w" target="_blank"><img src="{{ asset("public/images/soc-icon-youtube.png")}}" alt="" /></a></div>
                    <div class="f-soc__item"><a href="https://t.me/moy_okrug" target="_blank"><img src="{{ asset("public/images/soc-icon-tg.png")}}" alt="" /></a></div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__bottom-left">
                    <div class="f-cpr">
                        ????????????????.???? ???????????????????????? ???????????? ???????????????????? ????????????
                    </div>
                    <div class="f-policy">
                        <a href="/public/docs/Obrabotka_dannyh.pdf" target="_blank">???????????????? ????????????????????????????????????</a>
                    </div>
                </div>
                <div class="footer__bottom-right">
                    <!-- Rating Mail.ru logo -->
<a href="https://top.mail.ru/jump?from=3163487">
<img src="https://top-fwz1.mail.ru/counter?id=3163487;t=602;l=1" style="border:0;" height="40" width="88" alt="Top.Mail.Ru" /></a>
<!-- //Rating Mail.ru logo -->
                    </div>
                <!--
                <div class="footer__bottom-right">
                    <div class="f-develop"><a href="#">???????????????? ??????????</a> ???<br/> ???????????? VisualWeb</div>
                </div>
                -->
            </div>
        </div>
    </footer>
</div>
<!-- Rating Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "3163487", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = "https://top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="https://top-fwz1.mail.ru/counter?id=3163487;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" />
</div></noscript>
<!-- //Rating Mail.ru counter -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(60131500, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/60131500" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>

</html>

