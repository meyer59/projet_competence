@extends("layouts.eleve.template_eleve")
@section('title', 'menu')
@section("content_body")
    @parent
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->      
        <div  class="page-content" style="min-height:1080px">
            <!-- BEGIN PAGE HEAD-->

                 <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1> Accueil
                            <small>Compte etudiant - ORT Lyon <script type="text/javascript"> 
                                    d = new Date(); 
                                  document.write(" - "); 
                                  document.write(d.toLocaleDateString()); 
                                 document.write(" &nbsp;");
                                </script></small>
                        </h1>
                    </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
            <!-- END PAGE TOOLBAR -->
        </div>
                 <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-title">
                        <h1 align="center">Bienvenue sur l'application de note en ligne. </h1>
                        <div class="caption">
                                        <span class="caption-subject font-red bold uppercase"> Menu   
                                        </span>   
                        </div>
                    </div>
                    <div class="portlet-body form">
                            <div class="form-wizard">
                                <style>
                                     #global {
                                    position: relative; 
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 450px;
                                            }
                                </style>
                                <div class="form-body">
                                     
                                    <ul class="nav nav-pills nav-justified steps" >
                                        <div id="global">
                                            
                                                        <a href="{{ url("eleve/evaluation") }}" style="width:450px;height:90px;" class="btn blue-sharp button-submit"> <h2>M'AUTO - EVALUER</h2>
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                         <br><br>
                                                        <a href="{{ url("eleve/visualisation") }}" style="width:450px;height:90px; " class="btn blue-hoki button-submit"> <h2>MES RESULTATS</h2>
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                        <br><br>
                                                        <a href="{{ url("eleve/diplome") }}" style="width:450px;height:90px;" class="btn blue-hoki button-submit"> <h2>MES DIPLOMES</h2>
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                        <br><br>
                                                       <!-- <a href="" style="width:450px;height:90px;" class="btn grey-silver button-submit"> <h2>PARAMETRE</h2>
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>-->
                                       </div>
                                    </ul>
                                </div>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->

                <!-- END PAGE TOOLBAR -->
            
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <!-- BEGIN DASHBOARD STATS 1-->
@stop