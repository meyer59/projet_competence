
var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
           
            $("#select_classe").select2({
                placeholder: "Choisir une classe",
                allowClear: true,
                maximumSelectionSize : 1,
                width: 'auto',
                language: "fr"
            });
            $("#select_eleve").select2({
                placeholder: "Choisir au minimum un élève",
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
                selectableHeader:'<span class="bg-blue bg-font-blue">Choisir les competences à évaluer : </span>',
                selectionHeader:'<span class="bg-green bg-font-green">Competences choisies : </span>',
                afterSelect : function(value){
                    addToForm(value);
                },
                afterDeselect : function(value){
                    delToForm(value);
                }
            });
            var i = 0;
            function addToForm(value) // ajouter au formulaire de competence (final 3ieme etape)
            {
                //recuperation du optgroup
                var optgroup = ($.isArray(value)) ? $('#select_competence option[value="'+value[0]+'"]').closest('optgroup').prop('label') : $('#select_competence option[value="'+value+'"]').closest('optgroup').prop('label') ;
                //ajout du node titre
                if(!document.getElementById("titre"+optgroup))
                    $("#tab3 .competForm").append('<h3 class="block" id="titre'+optgroup+'"><span class="label label-info">'+optgroup+'</span></h3>');
                if($("#checkbox112_7").is(":checked"))
                {
                    $("#select_eleve > option").prop("selected","selected"); // si exam on selectionne tout les eleves de la classe

                }
                var tabEleve = $("#select_eleve").select2("val");
                //ajout de la competence selectionnee
                $.each(value,function(key,val){
                    i++;
                    $('[id="titre'+optgroup+'"]').after('<div class="panel panel-default fermdiv'+val+'" onclick="App.scrollTo($(this), -200);">'+//ajout titre de laccordeon
                                                         '<div class="panel-heading">' +
                                                            '<h4 class="panel-title">'+
                                                                '<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_'+i+'" aria-expanded="false">'+
                                                                $('#select_competence option[value="'+val+'"]').text()+
                                                                '</a>'+
                                                            '</h4>' +
                                                         '</div>' +
                        '<div id="collapse_3_'+i+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">'+// debut du div des competence
                        '<div class="panel-body" id="formgroup'+val+'">'
                    );
                    //ajouter chaque eleve pour la competence selectionné (competence1 eleve1 - competence1 eleve2 etc)
                    $("#formgroup"+val).after('<div class="row" id="formgroup'+val+'_">');
                    $.each(tabEleve,function(key,val2){
                        var eDiv="";
                        if(key==(tabEleve.length-1))
                        {
                            eDiv='</div>';
                        }
                        $("#formgroup"+val).append(
                            '<div id="formgroup'+val+'_" class="col-md-3">' +
                            '<div class="form-group">' +
                            '<label class="control-label">'+$('#select_eleve option[value="'+val2+'"]').text()+'</label>' +
                            '<input type="text" name="noteCompetId_'+val+'eleveId_'+val2+'" class="form-control sliderNote">' +
                            '<span class="help-block">&nbsp;</span>' +
                            '</div>' +
                            '</div>'+eDiv)
                    })
                    $('.row #formgroup'+val+'_').append("<hr>");
                    $(".fermdiv"+i).append('</div></div></div>');

                });
                $("#tab3 .competForm").append('</div>');
                $(".sliderNote").ionRangeSlider({
                    grid: true,
                    grid_num:4,
                    to_shadow:true,
                    min: 1,
                    max: 5
                }).on("change", function (obj) {  // appeler lorsque le slider des notes change. Affiche les commentaire sur la note
                    $that = $(this);
                    switch (parseInt($that.prop("value"))) // pour afficher le bon commentaire en fonction de la note attribuer
                    {
                        case 1:
                            $that.next('.help-block:first').text("Non acquis");
                            break;
                        case 2:
                            $that.next('.help-block:first').text("En cours d'acquisition");
                            break;
                        case 3:
                            $that.next('.help-block:first').text("A renforcer");
                            break;
                        case 4:
                            $that.next('.help-block:first').text("Acquis");
                            break;
                        case 5:
                            $that.next('.help-block:first').text("Maîtrisé");
                            break;
                    }
                });;
            }
            function delToForm(value) // suppr champ du formulaire de competence
            {
                $.each(value,function(key,val){
                   $('[id="formgroup'+val+'"]').remove();
                   $('[id="formgroup'+val+'_"]').remove();
                   $('.fermdiv'+val).remove();//('[class="panel panel-default"]:first').remove();
                });
                $.each($('[id^="titre"]'),function(key,val){
                   if(!$(val).next().is("div.panel"))
                   {
                       $(val).remove();
                   }
                });
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
                            .closest('.form-group').removeClass('has-error');//.addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error');//.addClass('has-success'); // set success class to the control group
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
                        //var targ = $("#form_wizard_1");
                        //     App.blockUI({
                        //        target:targ,
                        //        animate: true,
                        //        overlayColor: '#000000',
                        //        cenrerY: true
                        //    });
                        ////recuperation des competence affilier a la classe
                        // window.setTimeout(function() {
                        //        App.unblockUI(targ);
                        //    }, 1000);
                        
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

        }

    };

}();

jQuery(document).ready(function() {
    FormWizard.init();
});