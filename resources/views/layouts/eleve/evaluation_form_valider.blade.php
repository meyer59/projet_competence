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
                        <h1> Auto - evaluation
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
                        <h1 align="center">Votre formulaire d'auto-evaluation a été envoyé avec succés.</h1>
                        <br>
                        <div class="caption">                        
                                        <span class="caption-subject font-red bold uppercase"> Formulaire envoyé ...  
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
                                    width: 500px;
                                            }
                                </style>
                                <div class="form-body">
                                     
                                    <ul class="nav nav-pills nav-justified steps" >
                                        <div id="global">
                                                    
                                                <img style="width: 200px; display: block;  margin-left: auto; margin-right: auto;" src="https://anpsn.norauto.fr/catalogue/Xee/img/picto-yes.png">
                                                 <br><br><br>
                                                         <a href="{{ url("eleve/index") }}" style="width:500px;height:100px; " class="btn grey button-submit"> <h2>Retour au menu</h2>
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
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