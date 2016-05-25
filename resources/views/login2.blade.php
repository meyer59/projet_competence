<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Connexion au portail</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset("assets/global/css/components-rounded.min.css")}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset("assets/global/css/plugins.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/pages/css/login-3.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset("assets/layouts/layout4/css/layout.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/layouts/layout4/css/themes/light.min.css")}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset("assets/layouts/layout4/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
        <img src="{{ asset("assets/pages/img/logos/ort.png")}}" alt="Ort logo" style="height: 150px;width: auto;"/>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ url('/login') }}" method="post">
        {!! csrf_field() !!}
        <h3 class="form-title">Connectez-vous</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Entrez un nom d'utilisateur et un mot de passe. </span>
        </div>
        @if (!empty($errors) && count($errors) > 0)
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Oopps... </span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Nom d'utilisateur</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nom d'utilisateur" name="username" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Mot de passe</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Mot de passe" name="password" /> </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1" /> Se souvenir de moi </label>
            <button type="submit" class="btn green pull-right"> Connexion </button>
        </div>
        <div class="forget-password">
            <h4>Mot de passe oublié ?</h4>
            <p> Pas de soucis, cliquez
                <a href="javascript:;" id="forget-password"> ici </a> pour réinitialiser votre mot de passe. </p>
        </div>
        <div class="create-account">
            <p> Vous ne disposez pas encore de compte ? &nbsp;
                <a href="javascript:;" id="register-btn"> Créer un compte </a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" method="post" action="{{ url('/password/reset') }}">
        {!! csrf_field() !!}
        <h3>Mot de passe oublié ?</h3>
        <p> Entrez votre adresse email ci-dessous pour réinitialiser votre mot de passe. </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="on" placeholder="Email" name="email" /> </div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn grey-salsa btn-outline"> Back </button>
            <button type="submit" class="btn green pull-right"> Submit </button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="{{ url('/register') }}" method="post">
        {!! csrf_field() !!}
        <h3>S'inscrire</h3>
        <p> Entrez les détails de votre compte ci-dessous : </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Nom</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Nom" name="nom"  value="{{ old('nom') }}"/> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Prenom</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Prenom" name="prenom"  value="{{ old('prenom') }}" /> </div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"  value="{{ old('email') }}" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Mot de passe" name="password" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Retaper votre mot de passe</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Retaper votre mot de passe" name="rpassword" /> </div>
            </div>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="tnc" /> Je suis d'accord avec les
                <a href="javascript:;"> conditions d'utilisation </a> et
                <a href="javascript:;"> Politique de confidentialité </a>
            </label>
            <div id="register_tnc_error"> </div>
        </div>
        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn grey-salsa btn-outline"> Retour </button>
            <button type="submit" id="register-submit-btn" class="btn green pull-right"> S'inscrire </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
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
<script src="{{ asset("assets/pages/scripts/form-wizard.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/pages/scripts/login.min.js")}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset("assets/layouts/layout4/scripts/layout.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/layouts/layout4/scripts/demo.min.js")}}" type="text/javascript"></script>
<script src="{{ asset("assets/layouts/global/scripts/quick-sidebar.min.js")}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>