@extends("layouts.prof.template_prof")
@section('title', "Accueil professeur")
@section("css")
    @parent
 <link href="{{ asset("assets/global/plugins/fancybox/source/jquery.fancybox.css")}}" rel="stylesheet" type="text/css">
    @stop
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
                            <div class="row">
                       @foreach ($classes as $key=>$classe)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-4 ">
                                <div class="dashboard-stat blue-sharp margin-bottom-10">
                                    <div class="visual">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span>{{$classe["nom_classe"]}}</span>
                                        </div>
                                        <div class="desc"><span data-counter="counterup" data-value="{{$classe["nb_eleves"]}}">{{$classe["nb_eleves"]}}</span> élèves</div>
                                    </div>
                                    <a class="more" href="javascript:;" data-classe-id="{{$classe["classeId"]}}"> Plus d'informations
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
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-blue"></i>
                                <span class="caption-subject font-blue bold uppercase">Vos dernière évaluations</span>
                                <span class="caption-helper">Récapitulatif de vos dernière évaluations</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    @foreach($notations as $tab_note)
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> {{$tab_note["nom_eleve"]}} à obtenue <span class="label label-sm label-info ">{{$tab_note["note"]}}/5</span> sur la competente:
                                                                <span class="label label-sm label-default ">{{$tab_note["matiere"]}} - {{$tab_note["competence"]}}
                                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date" style="margin-left:-5px;"> {{$tab_note["date_note"]}} </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-blue"></i>
                                <span class="caption-subject font-blue bold uppercase">Historique</span>
                                <span class="caption-helper">Un bref historique de vos actions...</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    @foreach($historique as $action)
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-pencil-square-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"><span class="label label-sm label-info ">{{$action["action"]}}</span> {{$action["text_action"]}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date" style="width:140px;margin-left:-60px;"> {{$action["created_at"]}} </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END DASHBOARD STATS 1-->

            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@stop
@section("js")
    @parent
    <script src="{{ asset("assets/global/plugins/counterup/jquery.counterup.min.js")}}"></script>
    <script src="{{ asset("assets/global/plugins/counterup/jquery.waypoints.min.js")}}"></script>
    <script src="{{ asset("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
    <script src="{{ asset("assets/global/plugins/fancybox/source/jquery.fancybox.js")}}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            $('a[data-classe-id]').on("click",function(e){
                e.preventDefault();
                //console.log($(this).attr("data-classe-id"));
                $.fancybox({
                    type: 'iframe',
                    height: "auto",
                    autoResize:true,
                    centerOnScroll:true,
                    'iframe'           : {
                        scrolling : 'auto',
                        preload   : 'true'
                    },
                    'href': "{{url("prof/detail_classe")}}"+"?classeId="+$(this).attr("data-classe-id")
                });
            });
        });
    </script>
@stop