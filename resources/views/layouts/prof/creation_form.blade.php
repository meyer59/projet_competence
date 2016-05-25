@extends("layouts.prof.template_prof")
@section('title', 'Création de formulaire')
@section("content_body")
    @parent
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Form Wizard
                    <small>form wizard sample</small>
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
                                        <span class="caption-subject font-red bold uppercase"> Formulaire de competences
                                            <span class="step-title"> Etape 1 de 4 </span>
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
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Selection d'une categorie </span>
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
                                                                <i class="fa fa-check"></i> Creation du formulaire </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success"> </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block">Veuillez selectionner une categorie de competences</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Categorie
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-4">
                                                    <select name="categorie" id="select_categorie" class="form-control">
                                                        <option value=""></option>
                                                        <option value="AF">Afghanistan</option>
                                                        <option value="BO">Bolin Republic</option>
                                                        <option value="PG">Papua New Guinea</option>
                                                        <option value="PY">Paraguay</option>
                                                        <option value="PE">Peru</option>
                                                        <option value="PH">Philippines</option>
                                                        <option value="PN">Pitcairn</option>
                                                        <option value="PL">Poland</option>
                                                        <option value="PT">Portugal</option>
                                                        <option value="PR">Puerto Rico</option>
                                                        <option value="QA">Qatar</option>
                                                        <option value="RE">Reunion</option>
                                                        <option value="RO">Romania</option>
                                                        <option value="RU">Russian Federation</option>
                                                        <option value="RW">Rwanda</option>
                                                        <option value="KN">Saint Kitts and Nevis</option>
                                                        <option value="LC">Saint LUCIA</option>
                                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                                        <option value="WS">Samoa</option>
                                                        <option value="SM">San Marino</option>
                                                        <option value="ST">Sao Tome and Principe</option>
                                                        <option value="SA">Saudi Arabia</option>
                                                        <option value="SN">Senegal</option>
                                                        <option value="SC">Seychelles</option>
                                                        <option value="SL">Sierra Leone</option>
                                                        <option value="SG">Singapore</option>
                                                        <option value="SK">Slovakia (Slovak Republic)</option>
                                                        <option value="SI">Slovenia</option>
                                                        <option value="SB">Solomon Islands</option>
                                                        <option value="SO">Somalia</option>
                                                        <option value="ZA">South Africa</option>
                                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                        <option value="ES">Spain</option>
                                                        <option value="LK">Sri Lanka</option>
                                                        <option value="SH">St. Helena</option>
                                                        <option value="PM">St. Pierre and Miquelon</option>
                                                        <option value="SD">Sudan</option>
                                                        <option value="SR">Suriname</option>
                                                        <option value="SJ">Svalbard and Jan Mayen Islands</option>
                                                        <option value="SZ">Swaziland</option>
                                                        <option value="SE">Sweden</option>
                                                        <option value="CH">Switzerland</option>
                                                        <option value="SY">Syrian Arab Republic</option>
                                                        <option value="TW">Taiwan, Province of China</option>
                                                        <option value="TJ">Tajikistan</option>
                                                        <option value="TZ">Tanzania, United Republic of</option>
                                                        <option value="TH">Thailand</option>
                                                        <option value="TG">Togo</option>
                                                        <option value="TK">Tokelau</option>
                                                        <option value="TO">Tonga</option>
                                                        <option value="TT">Trinidad and Tobago</option>
                                                        <option value="TN">Tunisia</option>
                                                        <option value="TR">Turkey</option>
                                                        <option value="TM">Turkmenistan</option>
                                                        <option value="TC">Turks and Caicos Islands</option>
                                                        <option value="TV">Tuvalu</option>
                                                        <option value="UG">Uganda</option>
                                                        <option value="UA">Ukraine</option>
                                                        <option value="AE">United Arab Emirates</option>
                                                        <option value="GB">United Kingdom</option>
                                                        <option value="US">United States</option>
                                                        <option value="UM">United States Minor Outlying Islands</option>
                                                        <option value="UY">Uruguay</option>
                                                        <option value="UZ">Uzbekistan</option>
                                                        <option value="VU">Vanuatu</option>
                                                        <option value="VE">Venezuela</option>
                                                        <option value="VN">Viet Nam</option>
                                                        <option value="VG">Virgin Islands (British)</option>
                                                        <option value="VI">Virgin Islands (U.S.)</option>
                                                        <option value="WF">Wallis and Futuna Islands</option>
                                                        <option value="EH">Western Sahara</option>
                                                        <option value="YE">Yemen</option>
                                                        <option value="ZM">Zambia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block"></h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Liste des competences disponibles <span class="required"> * </span></label>
                                                <div class="col-md-8">
                                                    <select name="competence" multiple="multiple" id="select_competence" class="form-control">
                                                        <optgroup label="PHP">
                                                            <option value="Z1Wo">Zimbabwe</option>
                                                            <option value="1ZWp">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="Z0Wk">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                            <option value="4ZWo">Zimbabwe</option>
                                                        </optgroup>
                                                        <optgroup label="C++">
                                                            <option value="ZW7p">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="ZW5k">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                            <option value="Z74Wo">Zimbabwe</option>
                                                            <option value="Z14Wp">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="ZW74k">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                        </optgroup>
                                                        <optgroup label="C#">
                                                            <option value="ZWwq7p">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="ZqW5k">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                            <option value="Z7qwq4Wo">Zimbabwe</option>
                                                            <option value="Z14ffWp">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="ZWer74k">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                        </optgroup>
                                                        <optgroup label="HTML">
                                                            <option value="ZWgtp">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="ZW5cck">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                            <option value="Z74ggWo">Zimbabwe</option>
                                                            <option value="Znnb14Wp">Zimbabwefddddddddddv fvdddddddddddddddddfdddddddddddddddddddffffd</option>
                                                            <option value="ZWttg74k">Zimbabwedsf f fd  fddddddddddddddddddddddd fdfd fd  fd fd fd fd ?</option>
                                                        </optgroup>
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