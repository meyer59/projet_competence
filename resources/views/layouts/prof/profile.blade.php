@extends("layouts.prof.template_prof")
@section('title', "Profil utilisateur")
@section("css")
    <link href="{{ asset("assets/pages/css/profile.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{ asset("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css")}}" rel="stylesheet" type="text/css">
    @parent
   @stop
@section("content_body")
    @parent
    <div class="page-content" style="min-height:1231px">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Profil utilisateur
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
            <div class="page-toolbar">
                <!-- BEGIN THEME PANEL -->
                <!-- END THEME PANEL -->
            </div>
            <!-- END PAGE TOOLBAR -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet bordered">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{ asset("assets/pages/media/profile/prof_".Session::get('id_prof').".jpg")}}" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{$prenom}} {{$nom}} </div>
                            <div class="profile-usertitle-job"> {{$role}} </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    @if(session("statut")=="ok")
                    <div class="alert alert-block alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <h4 class="alert-heading">Success!</h4>
                        <p> {{session("msg")}} </p>
                        <p>
                            <a class="btn green" href="javascript:;"> Do this </a>
                            <a class="btn btn-link" href="javascript:;"> Cancel </a>
                        </p>
                    </div>
                    @endif
                    @if(session("statut")=="bad")
                        <div class="alert alert-block alert-error fade in">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            <h4 class="alert-heading">Success!</h4>
                            <p> {{session("msg")}} </p>
                            <p>
                                <a class="btn green" href="javascript:;"> Do this </a>
                                <a class="btn btn-link" href="javascript:;"> Cancel </a>
                            </p>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Paramètres du compte</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Mes coordonnées</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab">Changer ma photo</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab">Changer mon mot de passe</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                            <form role="form" method="post" action="{{url("prof/editProfil")}}">
                                                {{ csrf_field() }}
                                                <div class="form-group @if($errors->first('nom')) has-error @endif">
                                                    <label class="control-label">Nom</label>
                                                    <input type="text" name="nom" placeholder="" value="{{old("nom",$nom)}}" class="form-control">
                                                @if($errors->first('nom'))<span class="help-block">{{ $errors->first('nom') }}</span>  @endif
                                                </div>
                                                <div class="form-group @if($errors->first('prenom')) has-error @endif">
                                                    <label class="control-label">Prenom</label>
                                                    <input type="text" name="prenom" placeholder="" value="{{old("prenom",$prenom)}}" class="form-control">
                                                    @if($errors->first('prenom'))<span class="help-block">{{ $errors->first('prenom') }}</span>  @endif
                                                </div>
                                                <div class="form-group @if($errors->first('adresse')) has-error @endif">
                                                    <label class="control-label">Adresse</label>
                                                    <input type="text" name="adresse" placeholder="" value="{{ old("adresse",$adresse)}}" class="form-control">
                                                    @if($errors->first('adresse'))<span class="help-block">{{ $errors->first('adresse') }}</span>  @endif
                                                </div>
                                                <div class="form-group @if($errors->first('cp')) has-error @endif">
                                                    <label class="control-label">Code postale</label>
                                                    <input type="text" name="cp" placeholder="" value="{{old("cp",$cp)}}" class="form-control">
                                                    @if($errors->first('cp'))<span class="help-block">{{ $errors->first('cp') }}</span>  @endif
                                                </div>
                                                <div class="form-group @if($errors->first('ville')) has-error @endif">
                                                    <label class="control-label">Ville</label>
                                                    <input type="text" name="ville" placeholder="" value="{{old("ville",$ville)}}" class="form-control">
                                                    @if($errors->first('ville'))<span class="help-block">{{ $errors->first('ville') }}</span>  @endif
                                                </div>
                                                <div class="form-group @if($errors->first('telephone')) has-error @endif">
                                                    <label class="control-label">Téléphone</label>
                                                    <input type="text" name="telephone" placeholder="" value="{{old("telephone",$telephone)}}" class="form-control">
                                                    @if($errors->first('telephone'))<span class="help-block">{{ $errors->first('telephone') }}</span>  @endif
                                                </div>
                                                <div class="margiv-top-10">
                                                    <button class="btn green"> Valider </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE AVATAR TAB -->
                                        <div class="tab-pane" id="tab_1_2">
                                            <p> Metre à jour votre photo de profil</p>
                                            <form action="#" role="form">
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="{{ asset("assets/pages/media/profile/prof_".Session::get('id_prof').".jpg")}}" alt=""> </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Sélectionner une image </span>
                                                                            <span class="fileinput-exists"> Changer </span>
                                                                            <input type="file" name="image"> </span>
                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Effacer </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="margin-top-10">
                                                    <a href="javascript:;" class="btn green"> Valider </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                            <form action="#">
                                                <div class="form-group">
                                                    <label class="control-label">Mot de passe actuel</label>
                                                    <input type="actual-password" class="form-control"> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Nouveau mot de passe</label>
                                                    <input type="new-password" class="form-control"> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Confirmer votre nouveau mot de passe</label>
                                                    <input type="re-password" class="form-control"> </div>
                                                <div class="margin-top-10">
                                                    <a href="javascript:;" class="btn green"> Changer le mot de passe </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- PRIVACY SETTINGS TAB -->
                                        <div class="tab-pane" id="tab_1_4">
                                            <form action="#">
                                                <table class="table table-light table-hover">
                                                    <tbody><tr>
                                                        <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <div class="radio"><span><input type="radio" name="optionsRadios1" value="option1"></span></div> Yes </label>
                                                            <label class="uniform-inline">
                                                                <div class="radio"><span class="checked"><input type="radio" name="optionsRadios1" value="option2" checked=""></span></div> No </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <div class="checker"><span><input type="checkbox" value=""></span></div> Yes </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <div class="checker"><span><input type="checkbox" value=""></span></div> Yes </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <div class="checker"><span><input type="checkbox" value=""></span></div> Yes </label>
                                                        </td>
                                                    </tr>
                                                    </tbody></table>
                                                <!--end profile-settings-->
                                                <div class="margin-top-10">
                                                    <a href="javascript:;" class="btn red"> Save Changes </a>
                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
 @stop
@section("js")
    @parent
    <script src="{{ asset("assets/pages/scripts/profile.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/jquery.sparkline.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")}}" type="text/javascript"></script>
    <script>
        $( document ).ready(function() {

        });
    </script>
    @stop