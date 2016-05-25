@extends("layouts.prof.template_prof")
@section('title', "Évalutaion d'élève(s)")
@section("css")
    @parent
    <link href="{{ asset("assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css")}}" rel="stylesheet" type="text/css">
    <link href="{{ asset("assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinHTML5.css")}}" rel="stylesheet" type="text/css">
    @stop
@section("content_body")
    @parent
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Évaluation des élèves par le professeur
                    <small>suivre les instructions du formulaire ci-dessous</small>
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
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="form_wizard_1">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                                        <span class="caption-subject font-red bold uppercase"> Formulaire d'évaluation
                                            <span class="step-title"> Etape 1 de 3 </span>
                                        </span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                <i class="icon-cloud-upload"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                <i class="icon-wrench"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                <i class="icon-trash"></i>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="#" class="form-horizontal" id="submit_form" method="POST">
                            {{csrf_field()}}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Selection des élèves </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Selection des competences </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step active">
                                                <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Évaluation des élèves </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success"> </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button> Le formulaire contient des erreurs. </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button> Soumissions des notes reussie! </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block">Veuillez selectionner une classe</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Classe
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select name="categorie" id="select_classe" class="form-control" required="required">
                                                        @foreach($classes as $key=>$classe)
                                                            @echo <option value="{{$key}}">{{$classe}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <h3 class="block">Veuillez selectionner au minimum un élève</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Categorie
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select name="eleve[]" id="select_eleve" multiple="multiple" class="form-control" required>
                                                    </select>
                                                    <div class="md-checkbox-list">
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" id="select_all" class="md-check">
                                                            <label for="select_all">
                                                                <span class="inc"></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> Tout les élèves </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block"></h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Liste des competences disponibles <span class="required"> * </span></label>
                                                <div class="col-md-8">
                                                    <select name="competence" multiple="multiple" id="select_competence" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <a href="javascript:;" class="btn default grey-cascade button-previous">
                                                            <i class="fa fa-angle-left"></i> Retour </a>
                                                        <a href="javascript:;" class="btn btn-outline green button-next"> Continuer
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn green button-submit"  data-toggle="confirmation" data-placement="right"
                                                           data-btn-ok-label="Soumettre" data-btn-ok-icon="icon-like" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"
                                                           data-btn-cancel-icon="icon-close" data-btn-cancel-class="btn-danger" data-singleton="true" data-popout="true" title="Êtes-vous sûr ?" > Soumettre
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- creation du formulaire de competence -->
                                            <div id="competForm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn default grey-cascade button-previous">
                                                <i class="fa fa-angle-left"></i> Retour </a>
                                            <a href="javascript:;" class="btn btn-outline green button-next"> Continuer
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                            <a href="javascript:;" class="btn green button-submit"  data-toggle="confirmation" data-placement="right"
                                               data-btn-ok-label="Soumettre" data-btn-ok-icon="icon-like" data-btn-ok-class="btn-success" data-btn-cancel-label="Annuler"
                                               data-btn-cancel-icon="icon-close" data-btn-cancel-class="btn-danger" data-singleton="true" data-popout="true" title="Êtes-vous sûr ?" > Soumettre
                                                <i class="fa fa-check"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
 @stop
@section("js")
    @parent
    <script src="{{ asset("assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js")}}" type="text/javascript"></script>
    <script>
        $( document ).ready(function() {
            $(".sliderNote").on("change", function () {
                alert();
            });
            //pour selectionner tout les eleve dun coup
            $("#select_all").on("change",function(){
                if($("#select_all").is(':checked') ){
                    $("#select_eleve > option").prop("selected","selected");
                    $("#select_eleve").trigger("change");
                }else {
                    $("#select_eleve > option").removeAttr("selected");
                    $("#select_eleve").trigger("change");
                }
            });
            //recuperation des eleve de la classe choisie
           $("#select_classe").on("change",function(e){
               var that = $(this);
               $classe = that.val();
               //console.log($classe);
               $.ajax({
                   method: "GET",
                   type:"JSON",
                   url: "{{url("prof/geteleve")}}",
                   data: { classe: $classe },
                   success:function(donnees){
                       //console.log(donnees);
                       $("#select_eleve").empty();//vide la liste des eleves
                       $("#select_competence").empty(); // si on change de classe on vide les competence de la classe avec
                       $.each(donnees, function (i, item) {
                           $("#select_eleve").append("<option value="+i+">"+item+"</option>");
                       });
                   }
               })
               $("#select_eleve").val(null).trigger("change"); // actualisation du select2
               load_competence();
           });
            $("#select_eleve").on("change",function(e){
                load_competence();
            });
               //recuperation des competence selon la classe choisie
               function load_competence() {
                   $.ajax({
                       method: "GET",
                       type: "JSON",
                       url: "{{url("/prof/getcompetence")}}",
                       data: {classe: $("#select_classe").val()},
                       success: function (donnees) {
                           //console.log(donnees);
                           //$("#select_competence").multiSelect('deselect_all');
                           $("#select_competence").html('');
                           $.each(donnees.optgroup, function (i, item) {

                               $("#select_competence").append("<optgroup label=" + item + "></optgroup>");
                           });
                           $.each(donnees.options, function (i, item) {
                               //example: item = PHP alors ondoit iterer pour tt les competence
                               $.each(item, function (id, competence) {
                                   $('optgroup[label="' + i + '"]').append("<option value=" + id + ">" + competence + "</option>");
                               });
                           });
                           $("#tab3 #competForm").empty();
                           $("#select_competence").multiSelect('refresh');
                       }
                   });
               }

            //des le chargement de la pageon met a jour les donne
            $("#select_classe").trigger("change");
            //soumet le formulaire final apres la confirmation (popup de confirmation)
            $('#submit_form').on("confirmed.bs.confirmation",".button-submit",function () {
                $that = $("#form_wizard_1");
                App.blockUI({
                    target:$that,
                    animate: true,
                    overlayColor: '#000000',
                    cenrerY: false
                });
                $.ajax({
                    method: "POST",
                    type: "JSON",
                    url: "{{url("/prof/postcomptence")}}",
                    data: $("#submit_form").serialize(),
                    success: function (donnees) {

                    }
                });
                window.setTimeout(function() {
                    App.unblockUI($that);
                }, 1000);
                //alert('script de soumission du form');
            });
        });
    </script>
    @stop