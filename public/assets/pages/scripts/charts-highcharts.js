jQuery(document).ready(function() {
    Highcharts.setOptions({
        lang: {
            refreshButtonTitle: "Actualiser",
            months: ["Janvier", "Février", 'Mars', 'Avril', 'Mai', 'Juin',  'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            shortMonths: [ "Janv","Févr","Mars","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Déc"],
            weekdays: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            downloadSVG:"Télécharger en SVG",
            downloadJPEG:"Télécharger en JPEG",
            downloadPNG:"Télécharger en PNG",
            downloadPDF:"Télécharger en PDF",
            printChart:"Imprimer le graphique"
        }
    });
});
//fonction appeler lorsque le formulaire des critere est soumis, alors on creer les form
function init_graphe() {
    $.ajax({
        method: "GET",
        type: "JSON",
        url: url_chart_comparaison_prof_eleve,
        data: $("#form_rapport").serialize(),
        success: function (donnees) {
            $('.chart_rapport').show();
            $('#comparaison_prof_eleve').highcharts({
                zoomType: 'x',
                pinchType: 'x',
                chart: {
                   style: {
                        fontFamily: 'Open Sans'
                    }
                },
                title: {
                    text: null
                },
                xAxis: {
                    type: 'datetime',
                    minRange: 36000000, // 1h
                    labels: {
                        overflow: 'justify',
                        style: {
                            fontSize: '13px'
                        }
                    }
                },
                yAxis: {
                    labels: {
                        style: {
                            fontSize: '13px'
                        }
                    },
                    title: {
                        style: {
                            fontSize: '19px'
                        },
                        text: 'Note'
                    },
                    plotBands: [{ // Light air
                        from: 1.1,
                        to: 1.2,
                        label: {
                            text: 'Non acquis'
                        }
                    }, { // Light breeze
                        from: 2.1,
                        to: 2.2,
                        label: {
                            text: 'En cours d\'acquisition'
                        }
                    }, { // Gentle breeze
                        from: 3.1,
                        to: 3.2,
                        label: {
                            text: 'A renforcer'
                        }
                    }, { // Moderate breeze
                        from: 4.1,
                        to:4.2,
                        label: {
                            text: 'Acquis'
                        }
                    }, { // Fresh breeze
                        from: 5.1,
                        to: 5.2,
                        label: {
                            text: 'Maîtrisé'
                        }
                    }]
                },
                tooltip: {
                    valueSuffix: '/5'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                exporting: {
                    enabled: true
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        tooltip: {
                            xDateFormat: "%A, %e %b %Y, %H:%M"
                        },
                        marker: {
                            radius: 4
                        },
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 3
                            }
                        },
                        threshold: 1
                    }/*, series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function(e) {
                                    var note = (this.index)+1;
                                    //console.log("?note="+note+"classeId="+classeId+""+"competenceId="+competenceId)
                                    $.fancybox({
                                        type: 'iframe',
                                        height: "auto",
                                        autoResize:true,
                                        centerOnScroll:true,
                                        'iframe'           : {
                                            scrolling : 'auto',
                                            preload   : 'true'
                                        },
                                        'href': url_chart_detail_eleve_prof_fancybox+"?note="+note+"classeId="+classeId+""+"matiereId="+matiereId+"competenceId="+competenceId
                                    });
                                }
                            }
                        }
                    }*/
                },
                series: donnees //bien trier les valeurs dans l'ordre (error 15 HChart)

            })

        }
    });
    $.ajax({
        method: "GET",
        type: "JSON",
        url: url_chart_comparaison_eleve_eleve,
        data: $("#form_rapport").serialize(),
        success: function (donnees) {

            $('.chart_rapport').show();
            $('#comparaison_eleve_eleve').highcharts({
                zoomType: 'x',
                pinchType: 'x',
                chart: {
                    style: {
                        fontFamily: 'Open Sans'
                    },
                    events: {
                        drilldown: function (e) {
                            alert();
                        }
                    }
                },
                title: {
                    text: null
                },
                xAxis: {
                    type: "category",
                    labels: {
                        overflow: 'justify',
                        style: {
                            fontSize: '13px'
                        }
                    }
                },
                yAxis: {
                    labels: {
                        style: {
                            fontSize: '13px'
                        }
                    },
                    title: {
                        style: {
                            fontSize: '19px'
                        },
                        text: 'Nombre d\'élèves'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                exporting: {
                    enabled: true
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        tooltip: {
                            xDateFormat: "%A, %e %b %Y, %H:%M"
                        },
                        marker: {
                            radius: 4
                        },
                        lineWidth: 2,
                        states: {
                            hover: {
                                lineWidth: 3
                            }
                        },
                        threshold: 1
                    },
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function(e) {
                                    var note = (this.name).substr(0, 1);
                                    //var note = (this.index)+1;
                                    //console.log(this);
                                    $.fancybox({
                                        type: 'iframe',
                                        height: "auto",
                                        autoResize:true,
                                        centerOnScroll:true,
                                        'iframe'           : {
                                            scrolling : 'auto',
                                            preload   : 'true'
                                        },
                                        'href': url_chart_detail_eleve_fancybox+"?note="+note+"&classeId="+classeId+""+"&matiereId="+matiereId+"&competenceId="+competenceId+"&type_eval="+$('select[name="type_eval"]').val(),
                                    });
                                }
                            }
                        }
                    }
                },
                series:donnees //bien trier les valeurs dans l'ordre (error 15 HChart)
            })

        }
    });
}
