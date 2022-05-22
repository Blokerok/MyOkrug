<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ-панель - @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/jqvmap/jqvmap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("public/admin/dist/css/adminlte.min.css")}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{ asset("public/admin/plugins/summernote/summernote-bs4.min.css")}}">
    <link href="{{ asset("public/admin/dist/css/colorbox.css")}}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!--div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/public/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div-->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @if($new_uchastnik || $new_point)<span class="badge badge-warning navbar-badge">{{$new_uchastnik+$new_point}}</span>@endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{$new_uchastnik+$new_point}} событий(я)</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
     @if($new_uchastnik) <i class="far fa-bell"></i> {{$new_uchastnik}} нов. участник(а) фотоконкурсов <br />@endif
    @if($new_point)<i class="far fa-bell"></i> {{$new_point}} нов. точек озеленения @endif

</a>
<div class="dropdown-divider"></div>

</div>
</li>
<li class="nav-item">
<a class="nav-link" data-widget="fullscreen" href="#" role="button">
<i class="fas fa-expand-arrows-alt"></i>
</a>
</li>

</ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ route('homeAdmin') }}" class="brand-link">
<img src="/public/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light">Админ-панель</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img width="160" src="@if(file_exists(storage_path('app/public/avatars/'.Auth::user()->id.'/'.Auth::user()->avatar)))
{{asset('public/storage/avatars/'.Auth::user()->id.'/'.Auth::user()->avatar)}}
@else/public/admin/dist/img/user2-160x160.jpg
@endif" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">
<a href="#" class="d-block">{{ Auth::user()->name }}</a>
</div>
</div>


<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
data-accordion="false">
<!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->

<li class="nav-item">
    <a href="{{ route('homeAdmin') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Главная
        </p>
    </a>
</li>

<li class="nav-item">
<a href="#" class="nav-link">
    <i class="nav-icon fas fa-align-left"></i>
    <p>
        Cтраницы контента
        <i class="right fas fa-angle-left"></i>
    </p>
</a>
<ul class="nav nav-treeview">
    <li class="nav-item">
        <a href="{{ route('page.index') }}" class="nav-link">
            <p>Все страницы</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('page.create') }}" class="nav-link">
            <p>Добавить cтраницу</p>
        </a>
    </li>
</ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-align-left"></i>
        <p>
           Банеры
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('AllBaners') }}" class="nav-link">
                <p>Все банеры</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-newspaper"></i>
        <p>
            Новости
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('novost.index') }}" class="nav-link">
                <p>Все статьи</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('rubric.index') }}" class="nav-link">
                <p>Рубрики новостей</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('novost.create') }}" class="nav-link">
                <p>Добавить статью</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rubric.create') }}" class="nav-link">
                <p>Добавить рубрику</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-newspaper"></i>
        <p>
            Раздел "Один вопрос"
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('odinvopros.index') }}" class="nav-link">
                <p>Все материалы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('odinvopros.create') }}" class="nav-link">
                <p>Добавить материал</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Раздел "Моя история"
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('ludi.index') }}" class="nav-link">
                <p>Все статьи</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('ludi.create') }}" class="nav-link">
                <p>Добавить статью</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Раздел "Мой двор"
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('moy-dvor.index') }}" class="nav-link">
                <p>Все дворы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('moy-dvor.create') }}" class="nav-link">
                <p>Добавить двор</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-newspaper"></i>
        <p>
            Мой бизнес
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('moy-biznes.index') }}" class="nav-link">
                <p>Все материалы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categorii-biznesa.index') }}" class="nav-link">
                <p>Категории бизнеса</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('moy-biznes.create') }}" class="nav-link">
                <p>Добавить статью</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('categorii-biznesa.create') }}" class="nav-link">
                <p>Добавить категорию</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-camera-retro"></i>
        <p>
            Фотоконкурсы
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('uchastniki-fotokonkursov.index')}}" class="nav-link">
                <p>Все участники</p>
              @if($new_uchastnik)<span class="right badge badge-danger">модерация ({{$new_uchastnik}})</span>@endif
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('fotokonkurs.index')}}" class="nav-link">
                <p>Все фотоконкурсы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('uchastniki-fotokonkursov.create')}}" class="nav-link">
                <p>Добавить участника</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('fotokonkurs.create')}}" class="nav-link">
                <p>Добавить фотоконкурс</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Опросы
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('oprosu.index')}}" class="nav-link">
                <p>Все опросы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('groupu-oprosov.index')}}" class="nav-link">
                <p>Все группы</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('groupu-oprosov.create')}}" class="nav-link">
                <p>Добавить группу</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('oprosu.create') }}" class="nav-link">
                <p>Добавить опрос</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-crosshairs"></i>
        <p>
            Озеленение
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('ozelenenie.index')}}" class="nav-link">
                <p>Все озеленения</p>
                @if($new_point)<span class="right badge badge-danger">модерация ({{$new_point}})</span>@endif
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('categorii-ozelenenia.index')}}" class="nav-link">
                <p>Все категории</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('ozelenenie.create')}}" class="nav-link">
                <p>Добавить озеленение</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('categorii-ozelenenia.create')}}" class="nav-link">
                <p>Добавить категорию</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Пользователи
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
                <p>Все пользователи</p>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item">
    <a href="{{ url('/') }}" class="nav-link">
        <i class="nav-icon fas fa-angle-double-left"></i>
        <p>
            Вернуться на сайт
        </p>
    </a>
</li>

</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
@yield('content')
</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("public/admin/plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("public/admin/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<!-- Sparkline -->
<script src="{{ asset("public/admin/plugins/sparklines/sparkline.js")}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ asset("public/admin/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{ asset("public/admin/plugins/moment/moment-with-locales.min.js")}}"></script>
<!-- InputMask -->
<script src="{{ asset("public/admin/plugins/inputmask/jquery.inputmask.min.js")}}"></script>
<!-- date-range-picker -->
<script src="{{ asset("public/admin/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{ asset("public/admin/plugins/summernote/summernote-bs4.min.js")}}"></script>
<script src="{{asset("public/admin/plugins/summernote/lang/summernote-ru-RU.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset("public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!--ColorPicker-->
<script src="{{ asset("public/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js")}}"></script>
<!--DataTable-->
<script src="{{ asset("public/admin/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/jszip/jszip.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/pdfmake/pdfmake.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/pdfmake/vfs_fonts.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{ asset("public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js")}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset("public/admin/dist/js/adminlte.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("public/admin/dist/js/demo.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset("public/admin/dist/js/pages/dashboard.js")}}"></script>
<script type="text/javascript" src="{{ asset("public/admin/dist/js/jquery.colorbox-min.js")}}"></script>
<script src="{{ asset("public/admin/admin.js")}}"></script>

@if(request()->segment(2)=='moy-dvor' && (request()->segment(3)=='create'))
<script src="https://api-maps.yandex.ru/2.1/?apikey=d4764060-f47e-453f-8184-70c6cdea2e13&lang=ru_RU"></script>

<script>

ymaps.ready(init);

function init() {
var myPlacemark,
myMap = new ymaps.Map('map', {
center: [55.571804,38.223244],
zoom: 14
}, {
searchControlProvider: 'yandex#search'
});
myMap.cursors.push('pointer');
myMap.events.add('click', function (e) {
var coords = e.get('coords');

// Если метка уже создана – просто передвигаем ее.
if (myPlacemark) {
myPlacemark.geometry.setCoordinates(coords);
}
// Если нет – создаем.
else {
myPlacemark = createPlacemark(coords);
myMap.geoObjects.add(myPlacemark);
// Слушаем событие окончания перетаскивания на метке.
myPlacemark.events.add('dragend', function () {
$('#coord').val(myPlacemark.geometry.getCoordinates());
});
}
$('#coord').val(coords);
});

// Создание метки.
function createPlacemark(coords) {
return new ymaps.Placemark(coords, {
iconCaption: 'Укажите координаты двора'
},
{
// Опции.
// Необходимо указать данный тип макета.
iconLayout: 'default#image',
// Своё изображение иконки метки.
iconImageHref: '/public/images/moy-dvor.png',
// Размеры метки.
iconImageSize: [50, 50],
// Смещение левого верхнего угла иконки относительно
// её "ножки" (точки привязки).
iconImageOffset: [-20, -20],
draggable: true
});
}
}


</script>

@endif

<script>

$(document).ready(function() {



$('.editor').summernote({
lang: 'ru-RU', // default: 'en-US'
callbacks: {
onImageUpload: function (files) {
var el = $(this);
sendFile(files[0], el);
}
}
});
});
function sendFile(file, el) {
var  data = new FormData();
data.append("file", file);
var url = '{{ route('upload_imаge') }}';
$.ajax({
data: data,
type: "POST",
headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
url: url,
cache: false,
contentType: false,
processData: false,
success: function(url2) {
el.summernote('insertImage', url2);
}
});
}
</script>

<script>
$(function () {
$("#table_list").DataTable({
"responsive": true, "lengthChange": true, "autoWidth": false,"pagingType": "full_numbers",
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
"buttons": [ "excel", "pdf", "print"],
"order": [[ 0, "desc" ]]
}).buttons().container().appendTo('#table_list_wrapper .col-md-6:eq(0)');

$("#table_list_baners").DataTable({
"responsive": true, "lengthChange": true, "autoWidth": false,"pagingType": "full_numbers",
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
"buttons": [ "excel", "pdf", "print"],
"order": [[ 0, "asc" ]]
}).buttons().container().appendTo('#table_list_wrapper .col-md-6:eq(0)');

$('#reservationdate,#reservationdate2').datetimepicker({
locale: 'ru',
format: 'DD.MM.YYYY HH:mm',
icons: {
time: "fas fa-clock",
date: "fa fa-calendar",
up: "fa fa-arrow-up",
down: "fa fa-arrow-down"
}

});

$('.my-colorpicker1').colorpicker()
});

</script>
</body>

</html>
