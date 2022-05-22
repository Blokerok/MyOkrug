@extends('layouts.admin_layout')

@section('title', 'Главная')

@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Главная</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>

                            <p>Статьи новостей ({{$news_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document-text"></i>
                        </div>
                        <a href="{{ route('novost.index') }}" class="small-box-footer">Все статьи <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Рубрики новостей ({{$rubrics_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('rubric.index') }}" class="small-box-footer">Все рубрики <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>



            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>

                            <p>Материалы "Мой бизнес" ({{$moy_biz_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-briefcase"></i>
                        </div>
                        <a href="{{ route('moy-biznes.index') }}" class="small-box-footer">Все материалы <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Категории материалов "Мой бизнес" ({{$cat_biz_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('categorii-biznesa.index') }}" class="small-box-footer">Все категории <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>



            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>

                            <p>Участники фотоконкурсов ({{$uchastnikifoto_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>

                        </div>


                        <a href="{{ route('uchastniki-fotokonkursov.index') }}" class="small-box-footer">Все участники <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Фотоконкурсы ({{$fotokonkurs_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-camera"></i>
                        </div>
                        <a href="{{ route('fotokonkurs.index') }}" class="small-box-footer">Все фотоконкурсы <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>





            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>
                            <p>Озеленения({{$green_count}})</p>

                        </div>
                        <div class="icon">
                            <i class="ion ion-usb"></i>

                        </div>

                        <a href="{{ route('ozelenenie.index') }}" class="small-box-footer">Все озеленения <i
                                class="fas fa-arrow-circle-right"></i></a>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Категории озеленения ({{$catgreen_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('categorii-ozelenenia.index') }}" class="small-box-footer">Все категории <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>
                            "Опросы" ({{$opros_count}})

                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>

                        </div>

                        <a href="{{ route('oprosu.index') }}" class="small-box-footer">Все опросы <i
                                class="fas fa-arrow-circle-right"></i></a>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Группы опросов ({{$group_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('groupu-oprosov.index') }}" class="small-box-footer">Все группы опросов <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3></h3>

                            <p>Публикации "Моя история" ({{$ludi_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('ludi.index') }}" class="small-box-footer">Все публикации <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-blue">
                        <div class="inner">
                            <h3></h3>

                            <p>Репортажи "Один вопрос" ({{$odinvopros_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-videocamera"></i>
                        </div>
                        <a href="{{ route('odinvopros.index') }}" class="small-box-footer">Все репортажи <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->


            </div>

            <div class="row">


                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-maroon">
                        <div class="inner">
                            <h3></h3>

                            <p>"Мой двор" ({{$moyDvor_count}})</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('moy-dvor.index') }}" class="small-box-footer">Все дворы <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <!-- ./col -->


            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
