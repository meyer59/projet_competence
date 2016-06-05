@extends("layouts.prof.template_prof")
@section('title', "Évalutaion d'élève(s)")
@section("css")
    @parent
{{--    <link href="{{ asset("assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css")}}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset("assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{ asset("assets/global/plugins/fancybox/source/jquery.fancybox.css")}}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")}}" rel="stylesheet" type="text/css" />--}}
    @stop
@section("content_body")
    @parent
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Rapports des évaluations
                    <small></small>
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
        <div class="m-heading-1 border-green m-bordered">
          <form action="" class="form-horizontal" id="form_rapport">
              <input type="hidden" value="{{Auth::user()->id}}" name="id_prof">
           <div class="form-body">
                <h4 class="form-section">Choisir vos critères</h4>
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="control-label col-md-3">Classe<span class="required" aria-required="true"> * </span></label>
                            <div class="col-md-9">
                                <select data-placeholder="Choisir une classe" name="classe" class="form-control selectable2" required>
                                    <option value=""></option>
                                    @foreach($classes as $key=>$classe)
                                        @echo <option value="{{$key}}">{{$classe}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="control-label col-md-3">Élève<span class="required" aria-required="true"> * </span></label>
                            <div class="col-md-9">
                                <select data-placeholder="Choisir un élève" name="eleve" class="form-control selectable2" required disabled>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="control-label col-md-3">Matière<span class="required" aria-required="true"> * </span></label>
                            <div class="col-md-9">
                                <select data-placeholder="Choisir une matière" name="matiere" class="form-control selectable2" required disabled>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
               <div class="row">
                   <div class="col-md-4 col-lg-4">
                       <div class="form-group">
                           <label class="control-label col-md-3">Competence <span class="required" aria-required="true"> * </span></label>
                           <div class="col-md-9">
                               {{--<div class="input-group">--}}
                                   {{--<span class="input-group-addon"><input type="checkbox"></span>--}}
                                   <select value="" data-placeholder="Choisir une competence" name="competence" class="form-control selectable2" required disabled>
                                   </select>
                               {{--</div>--}}
                           </div>
                       </div>
                   </div>
                   <div class="col-md-4 col-lg-4">
                       <div class="form-group">
                           <label class="control-label col-md-3">Intervalle<span class="required" aria-required="true"> * </span></label>
                           <div class="col-md-9">
                               <div class="input-group" id="defaultrange">
                                   <span class="input-group-btn">
                                        <button class="btn default date-range-toggle" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                   <input type="text" name="intervalle-original" class="form-control" required>
                                   <input type="hidden" name="intervalle" value="" class="form-control" required>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-4 col-lg-4">
                       <div class="form-group">
                           <label class="control-label col-md-3">Type de note<span class="required" aria-required="true"> * </span></label>
                           <div class="col-md-9">
                               {{--<div class="input-group">--}}
                               {{--<span class="input-group-addon"><input type="checkbox"></span>--}}
                               <select  placeholder="Selectionner le type de note" name="type_eval" class="form-control" required>
                                   <option value="eval" selected>Professeur (type examen)</option>
                                   <option value="simple">Professeur (type simple)</option>
                                   <option value="eleve">Elève</option>
                                   <option value="all">Tout les types</option>
                               </select>
                               {{--</div>--}}
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-1 col-md-9">
                        <button type="submit" id="submit_form_rapport" class="btn btn-circle green">Valider</button>
                    </div>
                </div>
            </div>
          </form>
        </div>
        <!-- END PAGE BASE CONTENT -->
        {{--debut graphe--}}
        {{--comparaison prof eleve--}}
        <div class="tabbable-custom " style="display: none;">
            <ul class="nav nav-tabs ">
                <li class="active">
                    <a href="#tab_5_1" data-toggle="tab" aria-expanded="false"> Competences évaluées </a>
                </li>
                <li class="">
                    <a href="#tab_5_2" data-toggle="tab" aria-expanded="true"> Competences non évaluées </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_5_1">{{--debut tab pane evaluee--}}

                    <div class="row chart_rapport" style="display: none;">
                        <div class="col-md-12">
                            <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                    <div class="ribbon-sub ribbon-clip ribbon-right"></div><span class="ribbon_titre"></span></div>
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Comparaison des notes professeur - élève</span>
                                    </div>
                                    <div class="actions">
                                        <span class="competence_action"></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="comparaison_prof_eleve" style="height:500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--comparaison e tout les eleve--}}
                    <div class="row chart_rapport" style="display: none;">
                        <div class="col-md-12">
                            <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                    <div class="ribbon-sub ribbon-clip ribbon-right"></div><span class="ribbon_titre"></span></div>
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Notes de la classe</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="comparaison_eleve_eleve" style="height:500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--fin graphe--}}
                </div>{{-- fin tab pane evaluee--}}
                <div class="tab-pane" id="tab_5_2">
                    <div class="row chart_rapport" style="display: none;">
                        <div class="col-md-12">
                            <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                <div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                    <div class="ribbon-sub ribbon-clip ribbon-right"></div><span id="ribbon_noneval"></span>
                                </div>
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold ">Affichage des competences ne possédant aucune note</span>
                                    </div>
                                    <div class="actions">
                                        <span class="competence_action"></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    {{--code du tableau--}}
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-users font-dark"></i>
                                                <span class="caption-subject bold " id="classe_nom"></span>
                                            </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover" id="note_noneval">
                                                <thead>
                                                <tr>
                                                    <th> Matières </th>
                                                    <th> Competences </th>
                                                    <th> Type de notes </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @stop
@section("js")
    @parent
<script>
    //declaration des variable referent des url en js. Car il ny a pas de blade en js
    //url pour le graphe de comparaison eleve prof
    url_chart_comparaison_prof_eleve ="{{url("prof/graph_comparaisonProfEleve")}}";
    url_chart_comparaison_eleve_eleve ="{{url("prof/graph_comparaisonEleveEleve")}}";
    url_chart_detail_eleve_fancybox ="{{url("prof/graph_DetailEleve")}}";
    url_chart_detail_eleve_prof_fancybox="{{url("prof/graph_DetailEleveProf")}}";
    classeId = "";
    competenceId = "";
    matiereId = "";
    function init_tab() // charge le tablea datatable
    {
        $.ajax({
            method: "GET",
            type: "JSON",
            url: "{{url("prof/tab_competNonEval")}}",
            data: $("#form_rapport").serialize(),
            error: function (request, error) {
                toastr.error('Une erreur est surevenue. Si cela persite, rafraichissez la page', 'Oops...', {"newestOnTop": true,"progressBar": true,"preventDuplicates": false,"showDuration": "300","hideDuration": "1000","timeOut": "15000","extendedTimeOut": "10000"});
            },
            success: function (donnees) {
                $("#ribbon_noneval").text("Competence de type: "+ $('select[name="type_eval"] option:selected').text());
                $('#note_noneval').DataTable().clear();
                if(donnees.length > 0)
                {
                   $('#note_noneval').DataTable().rows.add(donnees).draw();
                }
            }
        });
    }
</script>
{{--    <script src="{{ asset("assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js")}}" type="text/javascript"></script>--}}
    <script src="{{ asset("assets/global/plugins/moment-with-locales.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/highcharts/js/highcharts.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/highcharts/js/highcharts-3d.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/highcharts/js/highcharts-more.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/highcharts/js/modules/exporting.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/highcharts/js/modules/export-csv.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/pages/scripts/charts-highcharts.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/fancybox/source/jquery.fancybox.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/datatables.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/pages/scripts/table-datatables-buttons.js")}}" type="text/javascript"></script>
    {{--<script src="{{ asset("assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js")}}" type="text/javascript"></script>--}}

    <script>
        $( document ).ready(function() {
            moment.locale('fr');//moment.js en francais pour la daterangepicker
            $('#form_rapport').validate(); //plugin validation de formulaire
            $('#defaultrange').daterangepicker({
                        opens: (App.isRTL() ? 'left' : 'right'),
                        format: 'DD/MM/YYYY',
                        separator: ' to ',
                        startDate: moment().subtract(29,'days'),
                        endDate: moment(),
                        ranges: {
                            'Aujourd\'hui': [moment(), moment()],
                            'Hier': [moment().subtract(1,'days'), moment().subtract( 1,'days')],
                            'Les 7 derniers jours': [moment().subtract(6,'days'), moment()],
                            'Les 30 derniers jours': [moment().subtract(29,'days'), moment()],
                            'Le mois actuel': [moment().startOf('month'), moment().endOf('month')],
                            'Le mois dernier': [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')],
                            'Les 6 derniers mois': [moment().subtract(6,'month').startOf('month'), moment()]
                        },
                        locale : {
                        format: 'DD/MM/YYYY',
                        separator: ' - ',
                        applyLabel: 'Valider',
                        cancelLabel: 'Annuler',
                        weekLabel: 'W',
                        customRangeLabel: 'Plage personnalisée',
                        daysOfWeek: moment.weekdaysMin(),
                        monthNames: moment.monthsShort(),
                        firstDay: moment.localeData().firstDayOfWeek()
                    },
                        minDate: '01/01/2016',
                        maxDate: '12/31/2099',
                    },
                    function (start, end) {
                        $('#defaultrange input:first').val(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                        $('#defaultrange input:eq(1)').val(start.format('YYYY-MM-DD') + '|' + end.format('YYYY-MM-DD'));
                    }
            );
            $(".selectable2").select2({
                allowClear: true,
                width: 'auto',
                language: "fr"
            });
            $(".selectable2").select2("val",'');
            //recuperation des eleve de la classe choisie
            $('select[name="classe"]').on("change",function(e){
                var that = $(this);
                $classe = that.val();
                //console.log($classe);
                $.ajax({
                    method: "GET",
                    type:"JSON",
                    url: "{{url("prof/eleveEtmatiereEnjson")}}",
                    error: function (request, error) {
                        toastr.error('Une erreur est surevenue. Si cela persite, rafraichissez la page', 'Oops...', {"newestOnTop": true,"progressBar": true,"preventDuplicates": false,"showDuration": "300","hideDuration": "1000","timeOut": "15000","extendedTimeOut": "10000"});
                    },
                    data: { classe: $classe },
                    success:function(donnees){
                        $('select:not(select[name="classe"],select[name="type_eval"])').empty();//vide la liste des eleves
                        $('select[name="eleve"]').append('<option value=""></option>');//option vide pour le placeholder
                        $.each(donnees.eleve, function (i, item) { // rempli le select des eleve
                           $('select[name="eleve"]').append('<option value="'+i+'">'+item+'</option>');
                        });
                        $('select[name="matiere"]').append('<option value=""></option>');//option vide pour le placeholder
                        $.each(donnees.matiere, function (i, item) { //rempli le select des matieres
                           $('select[name="matiere"]').append('<option value="'+i+'">'+item+'</option>');
                        });
                        $('select:not(select[name="competence"])').removeAttr("disabled")//on reactive les input,sauf celui des competence, on attend le choix de la matiere
                    }
                })
            });
            //recuperation des competence selon la matiere
            $('select[name="matiere"]').on("change",function(e){
                var that = $(this);
                $matiere = that.val();
                //console.log($classe);
                $.ajax({
                    method: "GET",
                    type:"JSON",
                    url: "{{url("prof/getcompetenceByMatiere")}}",
                    error: function (request, error) {
                        toastr.error('Une erreur est surevenue. Si cela persite, rafraichissez la page', 'Oops...', {"newestOnTop": true,"progressBar": true,"preventDuplicates": false,"showDuration": "300","hideDuration": "1000","timeOut": "15000","extendedTimeOut": "10000"});
                    },
                    data: { matiere: $matiere },
                    success:function(donnees){
                        $('select[name="competence"]').empty();
                        $('select[name="competence"]').append('<option value=""></option>');//option vide pour le placeholder
                        $.each(donnees.competence, function (i, item) { //rempli le select des competence
                           $('select[name="competence"]').append('<option value="'+i+'">'+item+'</option>');
                        });
                        $('select[name="competence"]').trigger("change");//pour mettre a jour le select2
                        $('select[name="competence"]').removeAttr("disabled")//on reactive le input
                    }
                })
            });
            $('#form_rapport').on("submit",function(e){ //soumission du formulaire pour creer les rapport
                e.preventDefault();
                if ($(this).valid() == false) {
                    return false;
                }
                var targ = $(this);
                App.blockUI({
                    target:targ,
                    animate: true,
                    overlayColor: '#000000',
                    cenrerY: true
                });
                $(".ribbon_titre").text($('select[name="matiere"] option:selected').text() +" - "+ $('select[name="competence"] option:selected').text()); //Maj des rubban
                $("#classe_nom").text( $('select[name="classe"] option:selected').text());
                $(".tabbable-custom").show();
                competenceId = $('select[name="competence"] option:selected').val();
                classeId = $('select[name="classe"] option:selected').val();
                matiereId = $('select[name="matiere"] option:selected').val();
                init_graphe();
                init_tab();
                App.unblockUI(targ);
            });
        });
    </script>
    @stop