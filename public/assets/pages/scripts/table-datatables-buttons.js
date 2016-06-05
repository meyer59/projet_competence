var TableDatatablesButtons = function () {

    var initTable1 = function () {
        var table = $('#detail_eleve');

        var oTable = table.dataTable({
            fnInitComplete: function (settings, data) {
                //alert( 'Saved filter was:  ');
            },

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},


            buttons: [
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Colonnes'},
                { extend: 'print', className: 'btn dark btn-outline',text: 'Imprimer',title: 'Elèves de la classe '+ $("#classeNom").text()} ,
                { extend: 'copy', className: 'btn red btn-outline',text: 'Copier',title: ' Elèves de la classe '+ $("#classeNom").text()} ,
                { extend: 'pdf', className: 'btn green btn-outline',title: 'Elèves de la classe '+ $("#classeNom").text() },
                { extend: 'excel', className: 'btn yellow btn-outline ',title: 'Elèves de la classe '+ $("#classeNom").text() },
                { extend: 'csv', className: 'btn purple btn-outline ',title: 'Elèves de la classe '+ $("#classeNom").text() }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: true,

            //"ordering": false, disable column ordering 
            //"paging": false, disable pagination

            "order": [
                [0, 'asc']
            ],

            "aLengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "Tout"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    var initTable2 = function () {

        var table = $('#note_noneval');

        var oTable = table.dataTable({
            fnInitComplete: function (settings, data) {
                //alert( 'Saved filter was:  ');
            },

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},


            buttons: [
                { extend: 'print', className: 'btn dark btn-outline',text: 'Imprimer',title: 'Competences sans notes de type: '+$('select[name="type_eval"] option:selected').text()} ,
                { extend: 'copy', className: 'btn red btn-outline',text: 'Copier',title: 'Competences sans notes de type: '+$('select[name="type_eval"] option:selected').text()} ,
                { extend: 'pdf', className: 'btn green btn-outline',title: 'Competences sans notes de type: '+$('select[name="type_eval"] option:selected').text() },
                { extend: 'excel', className: 'btn yellow btn-outline ',title: 'Competences sans notes de type: '+$('select[name="type_eval"] option:selected').text() },
                { extend: 'csv', className: 'btn purple btn-outline ',title: 'Competences sans notes de type: '+$('select[name="type_eval"] option:selected').text() }
            ],
            aoColumns: [
                {mDataProp: 'nom_matiere'},
                {mDataProp: 'nom_competence'},
                {mDataProp: 'nom_type'}
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: true,

            //"ordering": false, disable column ordering
            //"paging": false, disable pagination

            "order": [
                [0, 'asc']
            ],

            "aLengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "Tout"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
            initTable2();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});