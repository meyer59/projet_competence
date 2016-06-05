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
                <h1> Mes diplomes
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
                        <h1 align="center">Diplome obtenu. </h1>
                        <br>
                        <div class="caption">
                            <span class="caption-subject font-red bold uppercase">Vos diplomes obtenu

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
                                    width: 1150px;
                                }
                            </style>
                            <div class="form-body">

                                <ul class="nav nav-pills nav-justified steps" >
                                    <div id="global">
                                        <!-- BEGIN DASHBOARD STATS 1-->
                                        <div class="row">

                                            <?php
                                            foreach ($resultdiplome as $niveau => $cle ) {
                                                foreach ($cle as $clediplome => $mentiondiplome){

                                                switch ($niveau) { // pour preciser la note en fonction du resultat
                                                    case 1:
                                                        $colordiplome = "blue";
                                                        break;
                                                    case 2:
                                                        $colordiplome = "red";
                                                        break;
                                                    case 3:
                                                        $colordiplome = "green";
                                                        break;
                                                    case 4:
                                                        $colordiplome = "purple";
                                                        break;
                                                    case 5:
                                                        $colordiplome = "purple";
                                                        break;
                                                    default:
                                                        $colordiplome = "yellow";
                                                }
                                                
                                                if($mentiondiplome == ""){
                                                    $mentiondiplome = "";                                                    
                                                }
                                                else
                                                    $mentiondiplome = "Mention : $mentiondiplome - "; 
                                                echo '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                                    <a class="dashboard-stat dashboard-stat-v2 ' . $colordiplome . '" href="#">
                                                                        <div class="visual">
                                                                            <i class="fa fa-bar-chart-o"></i>
                                                                        </div>
                                                                        <div class="details">
                                                                            <div class="number">
                                                                                <span data-counter="counterup" data-value="">' . $clediplome . '</span>
                                                                            </div>
                                                                            <div class="desc"> '.$mentiondiplome.'Niveau ' . $niveau . ' </div>
                                                                        </div>
                                                                    </a>
                                                                    <br>
                                                                </div> ';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <!-- END DASHBOARD STATS 1-->  
                                    </div>
                                </ul>
                                <?php
                                //var_dump($resultdiplome);
                                ?>
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