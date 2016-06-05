<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <title>@yield("title")</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{ asset("assets/global/plugins/pace/pace.min.js")}}" type="text/javascript"></script>
    @section('css')
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/pace/themes/pace-theme-flash.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/simple-line-icons/simple-line-icons.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/uniform/css/uniform.default.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset("assets/global/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/select2/css/select2-bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/jquery-multi-select/css/multi-select.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/datatables/datatables.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css")}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset("assets/global/css/components-rounded.min.css")}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset("assets/layouts/layout4/css/layout.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/layouts/layout4/css/themes/light.min.css")}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset("assets/layouts/layout4/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/global/plugins/bootstrap-toastr/toastr.min.css")}}" rel="stylesheet" type="text/css">
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />

    @show
</head>
<body>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-users font-dark"></i>
            <span class="caption-subject bold ">Classe: <span id="classeNom"> {{$nom_classe}}</span>
        </div>
        <div class="tools"> </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="detail_eleve">
            <thead>
            <tr>
                <th> Nom </th>
                <th> Prénom </th>
                <th> Adresse</th>
                <th> Ville </th>
                <th> Code postale </th>
                <th> Date de naissance </th>
            </tr>
            </thead>
            <tbody>
            @foreach($eleves as $eleve)
            <tr>
                <td>
                    <a href="javascript:;"  data-namekey="nom" data-name="nom" data-title="Entrer un nom" data-type="text" data-pk="{{$eleve["id_eleve"]}}" data-original-title="Entrer un nom" class="tdeditable editable editable-click" style="display: inline;">  {{$eleve["nom"]}} </a>
                </td>
                <td>
                    <a href="javascript:;"  data-namekey="prenom" data-name="prenom" data-title="Entrer un prenom" data-type="text" data-pk="{{$eleve["id_eleve"]}}" data-original-title="Entrer un prenom" class="tdeditable editable editable-click" style="display: inline;">  {{$eleve["prenom"]}} </a>
                </td>
                <td>
                    <a href="javascript:;"  data-namekey="adresse" data-name="adresse" data-title="Entrer une adresse" data-type="text" data-pk="{{$eleve["id_eleve"]}}" data-original-title="Entrer une adresse" class="tdeditable editable editable-click" style="display: inline;">  {{$eleve["adresse"]}} </a>
                </td>
                <td>
                    <a href="javascript:;"  data-namekey="ville" data-name="ville" data-title="Entrer une ville" data-type="text" data-pk="{{$eleve["id_eleve"]}}" data-original-title="Entrer une ville" class="tdeditable editable editable-click" style="display: inline;">  {{$eleve["ville"]}} </a>
                </td>
                <td>
                    <a href="javascript:;"  data-namekey="cp" data-name="cp" data-title="Entrer un code postale" data-type="text" data-pk="{{$eleve["id_eleve"]}}" data-original-title="Entrer un code postale" class="tdeditable editable editable-click" style="display: inline;">  {{$eleve["cp"]}} </a>
                </td>
                <td>
                    <a href="javascript:;"  data-namekey="dob" data-name="dob" data-title="Entrer une date de naissance" data-type="date" data-pk="{{$eleve["id_eleve"]}}" data-format="dd/mm/yyyy" data-original-title="Entrer une date de naissance" class="tdeditable editable editable-click" style="display: inline;">  {{$eleve["dob"]}} </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--[if lt IE 9]>
<script src="{{ asset("assets/global/plugins/respond.min.js")}}"></script>
<script src="{{ asset("assets/global/plugins/excanvas.min.js")}}"></script>
<![endif]-->
<script src="{{ asset("assets/global/plugins/jquery.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/js.cookie.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery.blockui.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/uniform/jquery.uniform.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset("assets/global/plugins/select2/js/select2.full.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/pages/scripts/messages_fr.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js")}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset("assets/global/scripts/app.min.js")}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{{--<script src="{{ asset("assets/global/scripts/datatable.js")}}" type="text/javascript"></script>--}}
<script src="{{ asset("assets/global/plugins/datatables/datatables.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/pages/scripts/table-datatables-buttons.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js")}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset("assets/layouts/layout4/scripts/layout.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/layouts/layout4/scripts/demo.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/layouts/global/scripts/quick-sidebar.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/global/plugins/bootstrap-toastr/toastr.min.js")}}" type="text/javascript"></script>

<script>
    $( document ).ready(function() {
        $.fn.editable.defaults.mode = 'inline';
        $.fn.datepicker.dates['fr'] = {
            days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
            months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
            today: "Aujourd'hui",
            monthsTitle: "Mois",
            clear: "Effacer",
            weekStart: 1,
            format: "dd/mm/yyyy"
        };
        $.fn.editable.language='fr';
        /*$('.tdeditable').editable({
            {{--url: "{{url('/prof/updateEleve')}}",--}}
            name:"popo",
            error: function(response, newValue) {
                if (response.status === 500) {
                    return 'Erreur serveur';
                } else {
                    //console.log( response.responseJSON);
                    for (key in response.responseJSON){
                        return( response.responseJSON[key][0]);
                    }
                    // response.responseJSON[0][0];// != 'undefined' ? response.responseJSON.name[0] : response.responseJSON[$(this).attr("data-namekey")][0];//balancer la reponse du controller
                }
            },
            params: function(params) {
                //originally params contain pk, name and value
                params[$(this).attr("data-namekey")] = params.value; //la valeur du champ en key, nom=> value,prenom=>value etc
                return params;
            }
        });*/
       $('#detail_eleve').on('click', '.tdeditable', function () {
          $(this).editable({
                url: "{{url('/prof/updatppeEleve')}}",
                error: function(response, newValue) {
                    if (response.status === 500) {
                        return 'Erreur serveur';
                    }else if(response.status === 404){
                        toastr.error('Une erreur est surevenue. Si cela persite, rafraichissez la page', 'Oops...', {"newestOnTop": true,"progressBar": true,"preventDuplicates": false,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "10000"});
                    } else {
                        //console.log( response.responseJSON);
                        for (key in response.responseJSON){
                            return( response.responseJSON[key][0]);
                        }
                        // response.responseJSON[0][0];// != 'undefined' ? response.responseJSON.name[0] : response.responseJSON[$(this).attr("data-namekey")][0];//balancer la reponse du controller
                    }
                },
                params: function(params) {
                    //originally params contain pk, name and value
                    params[$(this).attr("data-namekey")] = params.value; //la valeur du champ en key, nom=> value,prenom=>value etc
                    return params;
                }
            }); $(this).editable('toggle');
        });
    });
</script>
</body>
</html>