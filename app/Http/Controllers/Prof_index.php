<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;

class Prof_index extends Controller
{
    public function getIndex()
    {
        //donner a recevoir dans la vue
        //notation: recupere les derniere notation effectuer par le proffeseur sur des eleve
        $arr_acceuil = ["title"=>"Acceuil professeur",
            "classes"=>[["nom_classe"=>"BTS SNIR",
                        "nb_eleves"=>"23",
                        "classeId"=>"12"
                        ],
                        ["nom_classe"=>"BTS IRIS1",
                        "nb_eleves"=>"18",
                            "classeId"=>"12"
                        ],
                        ["nom_classe"=>"BTS IRIS2",
                        "nb_eleves"=>"15",
                            "classeId"=>"12"
                        ],
                        ["nom_classe"=>"5MS2I",
                        "nb_eleves"=>"11",
                            "classeId"=>"12"
                        ],
                        ["nom_classe"=>"3CSI",
                        "nb_eleves"=>"26",
                            "classeId"=>"12"
                        ],
                        ["nom_classe"=>"BTS AG",
                        "nb_eleves"=>"28",
                            "classeId"=>"12"
                        ],

                        ],
            "notations"=>[["nom_eleve"=>"Meyer Layani","note"=>5,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>2,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Moche Matagrin Layani","note"=>1,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Benjamin Partouche","note"=>3,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Alexandre Blabla","note"=>4,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>2,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>3,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>5,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>2,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>1,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>3,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>4,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>1,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ["nom_eleve"=>"Meyer Layani","note"=>2,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ],
            "historique"=>[["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Connexion","text_action"=>"Connexion à votre compte","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Ajout de classe","text_action"=>"Ajout d'une classe à votre compte","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Ajout d'élèves","text_action"=>"Ajout d'élèves à votre compte","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"],
                        ],

        ];
        return view("layouts.prof.index",$arr_acceuil);
    }
    public function getEval()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $classe = [15=>"BTS IRIS",
            155=>"BTS SNIR",];
        $arr_acceuil = ["classes"=>$classe

        ];
        return view("layouts.prof.evaluation",$arr_acceuil);
    }
    public function eleveenjson()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $eleve = [1=>"meyer",7=>"moche",78=>"benji",79=>"thomas",11=>"BlackM",114=>"michel",117=>"barack",1115=>"mickael",1741=>"tiffany",511=>"mijou",1147=>"booba"];
        return response()->json($eleve);
    }
    public function eleveEtmatiereEnjson()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $eleve = [
            "eleve"=>[1=>"meyer",7=>"moche",78=>"benji",79=>"thomas",11=>"BlackM",114=>"michel",117=>"barack",1115=>"mickael",1741=>"tiffany",511=>"mijou",1147=>"booba"],
            "matiere"=>[145=>"PHP",14455=>"C++",44=>"JAVA",58=>"MATH",147=>"SCIENCE HUMAINE"]
        ];
        return response()->json($eleve);
    }
    public function getcompetencejson()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $optgroup=["PHP","HTML","JAVA","C++"];
        //Attention regrouper les competence par optgroup. Il ne peut pas avoir 2 fois la meme clef (ex 2 fois PHP)
        $competence = ["PHP"=>[15=>"savoir ecrire a lenver avecles pied",
                                1785=>"savoir reflechir",
                                1995=>"Savoir dire bonjour monsieurs et bonjour madame",
                                1522=>"savoir ecrik;lk;lkre a lenver"],
            "JAVA"=>[115=>"savoir dire bonjour"],
            "HTML"=>[1545=>"une competence super longue pask on en a envie et puis cest tout pask"],
            "C++"=>[15787=>"un apostrophe a l'envers"]];
        return response()->json(["optgroup"=>$optgroup,"options"=>$competence]);
    }
    public function postcomptence()//post les donne du formulaire de competence evaluer par le prof. Il faut les mettre en base
    {

       // return response()->json(["optgroup"=>$optgroup,"options"=>$competence]);
    }
    public function getRapport()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $arr_rapport = [
            "classes"=>[15=>"BTS IRIS",155=>"BTS SNIR"] // meme chose que la methode getEval (mais pas la meme chose que getIndex)
        ];
        return view("layouts.prof.rapport",$arr_rapport);
    }
    public function getEleveMatiere()//je transmet la classe en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $arr_rapport = [
            "classes"=>[15=>"BTS IRIS",155=>"BTS SNIR"], // meme chose que la methode getEval (mais pas la meme chose que getIndex)
        ];
        return view("layouts.prof.rapport",$arr_rapport);
    }
    public function getcompetenceByMatierejson()//je transmet la matiere en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        $arr_matiere = ["competence"=>[15=>"une competence super longue pask on en a envie et puis cest tout pask",
                     1555=>"Ecrire un programme c++",
                     1535=>"Manger des frite avec les main",
                     1545=>"Macher un chewing gum et faire des bulles",
                     1585=>"Sassoire debout en restant acroupie",
                     1525=>"Parler jusqua nen plus pouvoir pask je le veut et pask tu est tres beau"]
        ];
        return response()->json($arr_matiere);
    }
    public function graph_comparaisonProfEleve(request $req)//je transmet tout le formulaire des critere en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //data: [timestamp en ms des date de note,note eleve ou prof]
        $series = [
        [   "name"=>"Élève",//mettre le nom de leleve en vrai trasmis dans le input
            "type"=>"area",
            "data"=>[[1458952236000, 2], [1457656236000, 2], [1455150636000, 5], [1454373036000, 1], [1451694636000, 4], [1451953836000, 5], [1452126636000, 3], [1452472236000, 2], [1452904236000, 3]]
        ],
        [   "name"=>"Professeur",
            "type"=>"area",
            "data"=> [[1458952236000, 1], [1457656236000, 5], [1455150636000, 1], [1454373036000, 3], [1451694636000, 1], [1451953836000, 2], [1452126636000, 1], [1452472236000, 4], [1452904236000, 3]]
        ]
        ];
        return response()->json($series);
    }
    public function graph_comparaisonEleveEleve()//je transmet tout le formulaire des critere en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //data: [nom du libeler,total des eleve pour chaque note]
        $series = [[
           "name"=>"Nombre d'élèves",
            "type"=>"column",
            "colorByPoint"=>true,
            "data"=> [["1 - Non acquis",20],["2 - En cours d'aquisition",10],["3 - A renforcer",30],["4 - Acquis",25],["5 - Maîtrisé",21]]
        ]];
        return response()->json($series);
    }

    public function graph_DetailEleve()//je transmet en get lorsque le chqrt est cliqué ceci:  classeId  matiereId competenceId note
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //data: [nom du libeler,total des eleve pour chaque note]
        $donnee_vue = [
            "nom_classe"=>"BTS IRIS",
            "eleves"=>[
            [
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],[
            "nom"=>"Layani",
            "prenom"=>"Meyer",
            "matiere"=>"Math",
            "competence"=>"fdoijvdfldkfbvjl kldfjvlkdfjvklj lkdjfvlkfdjvklj lkdjfvklj",
            "note"=>"5",
            "date"=>"12/02/2016",
            ],
        ]];
        return view("layouts.prof.graph_detail_eleve",$donnee_vue);
    }
    public function detail_classe()//je transmet  classeId  le id de la classe
    {
        //verif si la classe existe pour ce prof
        $donnee_vue = [
            "nom_classe"=>"BTS IRIS", // mettre le vrai nom selon lid de la classe
            "eleves"=>[
                [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ], [
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],
            ]];
        return view("layouts.prof.detail_classe",$donnee_vue);
    }
}
