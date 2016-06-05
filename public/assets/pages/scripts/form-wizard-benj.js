var data = [{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }];
var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
           
            $("#select_categorie").select2({
                placeholder: "Choisir une categorie",
                allowClear: true,
                maximumSelectionSize : 1,
                width: 'auto', 
                language: "fr"
            });
            $('[data-toggle="confirmation"]').confirmation({
                onConfirm: function(){alert()}
            });
            $("#select_competence").multiSelect({
                selectableOptgroup: true,
                selectableHeader:'<span class="bg-blue bg-font-blue">Choisir vos competences : </span>',
                selectionHeader:'<span class="bg-green bg-font-green">Competence choisies : </span>',
                afterSelect : function(value){
                    
                    addToForm(value);
                },
                afterDeselect : function(value){
                    delToForm(value);
                }
            });
            function addToForm(value) // ajouter au formulaire de competence
            {

                //recuperation du optgroup
                var optgroup =  $('#select_matiere option:selected').text() ;
                
                //ajout du node titre
                if(!document.getElementById("titre"+optgroup))
                    $("#tab3").append('<h3 class="block" id="titre'+optgroup+'"><span class="label label-info">'+optgroup+'</span></h3>');
                 
                
                //ajout de la competence selectionnee
                $.each(value,function(key,val){
                                     
                $('#tab3').append('<div class="form-group form-md-line-input" id="formgroup'+val+'">\n\
                                                </br>\n\
                                                <h4> <input type="radio" class=”” name="radio_'+val+'" value="1"> Non acquis &nbsp; &nbsp; <input class=”toggle”  type="radio" name="radio_'+val+'" value="2"> En cours d\'acquisition &nbsp; &nbsp; <input class=”toggle”  type="radio" name="radio_'+val+'" value="3"> A renforcer &nbsp; &nbsp; <input class=”toggle”  type="radio" name="radio_'+val+'" value="4" checked="checked"> Acquis &nbsp; &nbsp;<input class=”toggle”  type="radio" name="radio_'+val+'" value="5"> Maîtrisé </h4>\n\
                                                </br> \n\
                                                <input id="com_'+val+'" type="text" name="com_'+val+'" placeholder="Ajouter un commentaire personnel..." class="form-control">\n\
                                                <label class="bold" for="com_'+val+'" >'+$('#select_competence option[value="'+val+'"]').text()+'</label>\n\
                                                 </br>   \n\
                                                    </div>');
                });                       

            }

            
            function delToForm(value) // suppr champ du formulaire de competence
            {
                $.each(value,function(key,val){
                   $('[id="formgroup'+val+'"]').remove();
                });
                $.each($('[id^="titre"]'),function(key,val){
                   if(!$(val).next().is("div.form-group"))
                   {
                       $(val).remove(); console.log($(val).text()+" removed")
                   }
                });
                console.log()
            }
//pour ajouter des option dans le select avc ajax $('#your-select').multiSelect('addOption', { value: 'test', text: 'test', index: 0, nested: 'optgroup_label' });
            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //account
                    categorie: {
                        required: true
                    },
                    competence: {
                        required: true
                    }
                },
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    alert();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Etape ' + (index + 1) + ' de ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    //return false;
                    
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    if($("#tab3").hasClass('active'))
                      $("#submit_form").removeClass("form-horizontal");
                    else
                      $("#submit_form").addClass("form-horizontal");
                  
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    
                    if (form.valid() == false) {
                        return false;
                    }
                    if(index == 1) //on recupere les donnee selon la valeur du select
                    { 
                        var targ = $("#form_wizard_1");
                             App.blockUI({
                                target:targ,
                                animate: true,
                                overlayColor: '#000000',
                                cenrerY: true
                            });
                            window.setTimeout(function() {
                                App.unblockUI(targ);
                            }, 1000);
                        
                    }
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    if($("#tab3").hasClass('active'))
                      $("#submit_form").removeClass("form-horizontal");
                    else
                      $("#submit_form").addClass("form-horizontal");
                  
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous,.button-submit').hide();
            $('#submit_form').on("confirmed.bs.confirmation",".button-submit",function () {
                    
                document.getElementById("submit_form").submit();
                 //href="{{ url("eleve/evaluation_form_valider") }}";
               // alert(document.forms['liste_competence'].bidule.value);
            });
        }

    };

}();

jQuery(document).ready(function() {
    FormWizard.init();
});