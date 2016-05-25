@extends("layouts.prof.template_prof")
@section('title', $title)
@section("content_body")
    @parent
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height:1080px">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Tableau de bord
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->

                <!-- END PAGE TOOLBAR -->
            </div>
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Vos classes
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="" class="fullscreen" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                       @foreach ($classes as $classe)
                            <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                <div class="dashboard-stat blue margin-bottom-5">
                                    <div class="visual">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="{{$classe["nom_classe"]}}">{{$classe["nom_classe"]}}</span>
                                        </div>
                                        <div class="desc">{{$classe["nb_eleves"]}} élèves</div>
                                    </div>
                                    <a class="more" href="javascript:;"> Plus d'informations
                                        <i class="m-icon-swapright m-icon-white"></i>
                                    </a>
                                </div>
                            </div>
                         @endforeach
                    </div>
                        </div>
                    </div>
                </div>
            <div class="clearfix"></div>
            <!-- END DASHBOARD STATS 1-->

            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@stop