<?php

namespace App\Http\Controllers;

use App\Models\EvaluerSimplement;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\User;
use App\Models\LogAction;
use App\Models\Intervient;
use App\Models\Appartenir;
use Illuminate\Support\Facades\Auth;
use App\Models\Competence;
use App\Models\Groupe;
use Hash;


class Prof_index extends Controller
{
    public function getIndex()
    {
        //donner a recevoir dans la vue
        //notation: recupere les derniere notation effectuer par le proffeseur sur des eleve
        /*$arr_acceuil = ["title"=>"Acceuil professeur",
            "classes"=>[["nom_classe"=>"BTS SNIR", "nb_eleves"=>"23", "classeId"=>"12"],
                        ],
            "notations"=>[["nom_eleve"=>"Meyer Layani","note"=>5,"matiere"=>"PHP","competence"=>"savoir ecrire une variable","date_note"=>"12/01/2016"],
                        ],
            "historique"=>[["action"=>"Notation","text_action"=>"Notation effectué pour Meyer layani","date_action"=>"12/01/15 15:01"]]
        ];*/
        $arr_acceuil = ['title'=>'acceuil prof',
                        'classes'=>User::getProfClasses(Auth::user()->id),
                        "notations"=>(User::getLastNoteEpreuve(Auth::user()->id)),
                        "historique"=>(LogAction::show(Auth::user()->id))];
        //var_dump(Auth::user()->id);
        //var_dump($arr_acceuil);
        return view("layouts.prof.index",$arr_acceuil);
    }
    public function getEval()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        /*$classe = [15=>"BTS IRIS",
            155=>"BTS SNIR",];*/
        $arr_acceuil = ["classes"=>Intervient::getProfClass(Auth::user()->id)
        ];
        return view("layouts.prof.evaluation",$arr_acceuil);
    }
    public function eleveenjson(Request $request)
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        if(Intervient::ProfIntervientClass(Auth::user()->id,$request->input('classe')))
        {
            //var_dump(Appartenir::getEleveGroupe($request->input('classe')));
            return response()->json(Appartenir::getEleveGroupe($request->input('classe')));
        }
        else return response("",422);
        //$eleve = [1=>"meyer",7=>"moche",78=>"benji",79=>"thomas",11=>"BlackM",114=>"michel",117=>"barack",1115=>"mickael",1741=>"tiffany",511=>"mijou",1147=>"booba"];

    }
    public function eleveEtmatiereEnjson(Request $request)
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        if(Intervient::ProfIntervientClass(Auth::user()->id,$request->input('classe')))
        {
            $eleve=[
                "eleve" => Appartenir::getEleveGroupe($request->input('classe')),
                "matiere" => Intervient::getMatiereGroupeProf(Auth::user()->id,$request->input('classe'))
            ];
            //var_dump($eleve);
            return response()->json($eleve);
        }
        else return response("",422);
        /*$eleve = [
            "eleve"=>[1=>"meyer",7=>"moche",78=>"benji",79=>"thomas",11=>"BlackM",114=>"michel",117=>"barack",1115=>"mickael",1741=>"tiffany",511=>"mijou",1147=>"booba"],
            "matiere"=>[145=>"PHP",14455=>"C++",44=>"JAVA",58=>"MATH",147=>"SCIENCE HUMAINE"]
        ];*/
    }
    public function getcompetencejson(Request $request)
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //var_dump(Competence::getCompetenceByClass($request->input('classe'),Auth::user()->id));
        $optgroup=["PHP","HTML","JAVA","C++"];
        $optgroup = Competence::getClassMatiere($request->input('classe'),Auth::user()->id);
        //Attention regrouper les competence par optgroup. Il ne peut pas avoir 2 fois la meme clef (ex 2 fois PHP)
        $competence = ["PHP"=>[15=>"savoir ecrire a lenver avecles pied",
                                1785=>"savoir reflechir",
                                1995=>"Savoir dire bonjour monsieurs et bonjour madame",
                                1522=>"savoir ecrik;lk;lkre a lenver"],
            "JAVA"=>[115=>"savoir dire bonjour"],
            "HTML"=>[1545=>"une competence super longue pask on en a envie et puis cest tout pask"],
            "C++"=>[15787=>"un apostrophe a l'envers"]];
        $competence = Competence::getCompetenceByClass($request->input('classe'),Auth::user()->id);
        //var_dump(["optgroup"=>$optgroup,"options"=>$competence]);
        return response()->json(["optgroup"=>$optgroup,"options"=>$competence]);
    }
    public function postcomptence(Request $request)//post les donne du formulaire de competence evaluer par le prof. Il faut les mettre en base
    {
        if(!empty($request->input('eleve')) && !empty($request->input('competence')))
        {
            foreach($request->input('eleve') as $eleve)
            {
                foreach($request->input('competence') as $competence)
                {
                    $this->EvaluerSimplement($eleve,$competence,$request->input('noteCompetId_'.$competence.'eleveId_'.$eleve));
                }
            }
        }
        return var_dump(true);
    }

    public function EvaluerSimplement($id_eleve,$id_competence,$note)
    {
        $evaluer_simplement = new EvaluerSimplement();
        $evaluer_simplement->id_competence = $id_competence;
        $evaluer_simplement->users_id_prof = Auth::user()->id;
        $evaluer_simplement->users_id_eleve = $id_eleve;
        $evaluer_simplement->note_evaluerSimplement = $note;
        $evaluer_simplement->date_evaluerSimplement = date('Y/m/d H:i:s');
        $evaluer_simplement->save();
    }
    public function getRapport()
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        /*$arr_rapport = [
            "classes"=>[15=>"BTS IRIS",155=>"BTS SNIR"] // meme chose que la methode getEval (mais pas la meme chose que getIndex)
        ];*/
        $arr_rapport = ["classes"=>Intervient::getProfClass(Auth::user()->id)];
        return view("layouts.prof.rapport",$arr_rapport);
    }
    public function getEleveMatiere(Request $request)//je transmet la classe en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        /*$arr_rapport = [
            "classes"=>[15=>"BTS IRIS",155=>"BTS SNIR"], // meme chose que la methode getEval (mais pas la meme chose que getIndex)
        ];*/
        if(Intervient::ProfIntervientClass(Auth::user()->id,$request->input('classe'))){
            $arr_rapport = ["classes"=>Intervient::getProfClass(Auth::user()->id)];
            return view("layouts.prof.rapport",$arr_rapport);
        }
        else return response('',422);

    }
    public function getcompetenceByMatierejson(Request $request)//je transmet la matiere en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //var_dump(Competence::getAllCompetenceByGroupeCompetence($request->input('matiere')));
        /*$arr_matiere = ["competence"=>[15=>"une competence super longue pask on en a envie et puis cest tout pask",
                     1555=>"Ecrire un programme c++",
                     1535=>"Manger des frite avec les main",
                     1545=>"Macher un chewing gum et faire des bulles",
                     1585=>"Sassoire debout en restant acroupie",
                     1525=>"Parler jusqua nen plus pouvoir pask je le veut et pask tu est tres beau"]
        ];*/
        $arr_matiere = ['competence'=>Competence::getAllCompetenceByGroupeCompetence($request->input('matiere'))];
        return response()->json($arr_matiere);
    }
    public function graph_comparaisonProfEleve(request $req)//je transmet tout le formulaire des critere en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //data: [timestamp en ms des date de note,note eleve ou prof]
        /*$series = [
        [   "name"=>"Élève",//mettre le nom de leleve en vrai trasmis dans le input
            "type"=>"area",
            "data"=>[[1458952236000, 2], [1457656236000, 2], [1455150636000, 5], [1454373036000, 1], [1451694636000, 4], [1451953836000, 5], [1452126636000, 3], [1452472236000, 2], [1452904236000, 3]]
        ],
        [   "name"=>"Professeur",
            "type"=>"area", 
            "data"=> [[1458952236000, 1], [1457656236000, 5], [1455150636000, 1], [1454373036000, 3], [1451694636000, 1], [1451953836000, 2], [1452126636000, 1], [1452472236000, 4], [1452904236000, 3]]
        ],
            [   "name"=>"Professeur eval",
                "type"=>"area",
                "data"=> [[1458952236000, 1], [1457656236000, 5], [1455150636000, 1], [1454373036000, 3], [1451694636000, 1], [1451953836000, 2], [1452126636000, 1], [1452472236000, 4], [1452904236000, 3]]
            ]
        ];*/
        //return response()->json($series);
        $limit = explode('|', $req->input("intervalle"));
        if(!empty($limit[0]) && !empty($limit[1])) {
            $auto_eval = Competence::getEleveAutoEvalCompetence($req->input("eleve"), $req->input("competence"), $limit);
            $eval_simple = Competence::getEleveEvaluerSimplementCompetence($req->input("eleve"), $req->input("competence"), $limit,$req->input('id_prof'));
            $eval_epreuve = Competence::getEleveEvaluerEpreuveCompetence($req->input("eleve"), $req->input("competence"), $limit,$req->input('id_prof'));
            $data = [];
            if(!empty($auto_eval)) $data[]= $auto_eval;
            if(!empty($eval_simple)) $data[]= $eval_simple;
            if(!empty($eval_epreuve)) $data[]= $eval_epreuve;
            return response()->json($data);

        }
        else return response('',422);
    }
    public function graph_comparaisonEleveEleve(Request $request)//je transmet tout le formulaire des critere en get
    {
        //verif si la classe existe pour ce prof
        //donnee a recevoir dans la vue
        //data: [nom du libeler,total des eleve pour chaque note]
        $auto_eval = Competence::getcountNoteCompetenceAutoEval($request->input('classe'),$request->input('competence'));
        $eval_simple = Competence::getcountNoteCompetenceEvalSimple($request->input('classe'),$request->input('competence'),$request->input('id_prof'));
        $eval_epreuve = Competence::getCountNoteEvalEpreuve($request->input('classe'),$request->input('competence'));
        switch($request->input('type_eval'))
        {
            case 'eleve':
                $data = $auto_eval;
                break;
            case 'simple':
                $data = $eval_simple;
                break;
            case 'eval':
                $data = $eval_epreuve;
                break;
            default:
                $data = $auto_eval;

        }
        $series = [[
           "name"=>"Nombre d'élèves",
            "type"=>"column",
            "colorByPoint"=>true,
            "data"=> $data//[["1 - Non acquis",20],["2 - En cours d'aquisition",10],["3 - A renforcer",30],["4 - Acquis",25],["5 - Maîtrisé",21]]
        ]];
        return response()->json($series);
    }

    public function graph_DetailEleve(Request $request)//je transmet en get lorsque le chqrt est cliqué ceci:  classeId  matiereId competenceId note
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
              "id_eleve"=>mt_rand(0,9),
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
        $donnee_eleve_auto_eval = User::getcountNoteCompetenceAutoEvalDetail($request->input('classeId'),$request->input('competenceId'),$request->input('note'));
        $donnee_eleve_eval_simple = User::getcountNoteCompetenceEvalSimpleDetail($request->input('classeId'),$request->input('competenceId'),$request->input('note'));
        $donnee_vue = ['nom_classe' =>  Groupe::findOrFail($request->input('classeId'))->nom_groupe,'eleves' => $donnee_eleve_auto_eval];
        return view("layouts.prof.graph_detail_eleve",$donnee_vue);
        //var_dump($donnee_eleve_auto_eval);
    }
    public function detail_classe(Request $request)//je transmet  classeId  le id de la classe
    {
        //verif si la classe existe pour ce prof
        $donnee_vue = [
            "nom_classe"=>"BTS IRIS", // mettre le vrai nom selon lid de la classe
            "eleves"=>[
                [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ],  [
                    "id_eleve"=>mt_rand(0,9),
                    "nom"=>"Layani",
                    "prenom"=>"Meyer",
                    "adresse"=>"50 Boulvard des Belges",
                    "ville"=>"LYON",
                    "code_postale"=>"69006",
                    "dob"=>"12/02/1993",
                ]
            ]];
        $donnee_vue = ['nom_classe' =>  Groupe::findOrFail($request->input('classeId'))->nom_groupe,'eleves' => Groupe::getAllEleveGroupe($request->input('classeId'))];
        return view("layouts.prof.detail_classe",$donnee_vue);
    }

    public function tab_competNonEval(request $request)//Utilisaé pour le remplir tableau rapport des competences non evaluer.je transmet tout le formulaire des critere du rapport en get.
    {
        //le param type_tab => eval ,retourne le tableau des competence non evaluer de type examen
        //le param type_tab => simple ,retourne le tableau des competence non evaluer de type simple
        //le param type_tab => eleve ,retourne le tableau des competence non evaluer type eleve
        $validator =  $this->validate($request, [
            'type_eval' => 'required',
        ]);

        if($validator) {
            return response(["content"=>"bad parameters","status"=>"422"]);
        }
        $competence_sans_eval = [
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ],
            [   "nom_matiere"=>"PHP",
                "nom_competence"=>"savoir ecrire un code",
                "nom_type" => "eval"
            ]
        ];
        return response()->json($competence_sans_eval);
    }

///////MODIF PAR MEYER
    public function editProfilPhoto(request $request)//modification des donne du prof. aide sur les input laravel https://laravel.com/docs/5.2/requests#old-input
    {

        $validator = $this->validate($request, [
            'image' => 'image|required',
        ]);
        if ($validator) {
            return redirect(url()->previous() . "#tab_1_2")
                ->withErrors($validator)
                ->withInput()->with("statut", "bad");
        }
        $file_destination = "prof_" . Auth::user()->id . ".jpg";
        $directory_destination = public_path()."/assets/pages/media/profile/";

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($request->file('image')->move($directory_destination,$file_destination)) {
                return redirect(url()->previous() . "#tab_1_2")->with("statut", "ok")->with( "msg", "Les données ont bien été mis à jour");
            } else {
                return redirect(url()->previous() . "#tab_1_2")
                    ->withErrors($validator)
                    ->withInput()->with("statut", "bad")->with("msg","Impossible de copier l'image");
            }
        } else {
            return redirect(url()->previous() . "#tab_1_2")
                ->withErrors($validator)
                ->withInput()->with("statut", "bad")->with("msg","L'image a mal été transmise");
        }
    }

    public function editProfilpassword(request $request)//modification des donne du prof. aide sur les input laravel https://laravel.com/docs/5.2/requests#old-input
    {
        $validator =  $this->validate($request, [
            'actual-password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        if($validator) {
            return redirect(url()->previous()."#tab_1_3")
                ->withErrors($validator)
                ->with("statut","bad")->with("msg","Le mot de passe actuel est invalide");
        }
        //verif password
        $now_password   = $request->input('actual-password');
        if(Hash::check($now_password, Auth::user()->password)){
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($request->input("password"));
            $user->save();

            //si tout est ok. bdd et tout
            return redirect(url()->previous()."#tab_1_3")->with("statut","ok")->with("msg","Mise à jour avec succès"); //si c ok
        }else{

            return redirect(url()->previous()."#tab_1_3")
                ->withErrors($validator)
                ->withInput()->with("statut","bad")->with("msg","Le mot de passe actuel est invalide");
        }

    }

    public function getProfile()//la page profile du prof
    {
        //prendre le id en session pour le prof et voir si il correspond au id de lurl
        //donnee a recevoir dans la vue
        $donnee_vue = ["prenom"=>Auth::user()->prenom,
            "nom"=>Auth::user()->name,
            "adresse"=>Auth::user()->adresse,
            "ville"=>Auth::user()->ville,
            "cp"=>Auth::user()->cp,
            "telephone"=>Auth::user()->telephone,
            "role"=>Auth::user()->role,


        ];
        return view("layouts.prof.profile",$donnee_vue);
    }

    public function postEditProfil(request $request)//modification des donne du prof. aide sur les input laravel https://laravel.com/docs/5.2/requests#old-input
    {

        $validator =  $this->validate($request, [
            'nom' => 'required|max:50|',
            'prenom' => 'required|max:50',
            'cp' => 'required|max:50|alpha_num',
            'ville' => 'required|max:50',
            'adresse' => 'required|max:200',
            'telephone' => 'required||max:10|phone:FR,US',
        ]);
        if($validator) {
            return redirect(url()->previous()."#tab_1_1")
                ->withErrors($validator)
                ->withInput()->with("statut","bad");
        }
        $user = User::find(Auth::user()->id);
        $user->name = $request->input("nom");
        $user->prenom = $request->input("prenom");
        $user->cp = $request->input("cp");
        $user->ville = $request->input("ville");
        $user->adresse = $request->input("adresse");
        $user->telephone = $request->input("telephone");
        $user->save();
        //si tout est ok. bdd et tout
        return  redirect(url()->previous()."#tab_1_1")->with("statut","ok","msg","Les données ont bien été mis à jour"); //si c ok
        //sinon
        //return  back()->with("statut","bad","msg","Erreur dans la bdd"); // si c bad
    }
    public function updateEleve(request $request)//modification des donne du prof. aide sur les input laravel https://laravel.com/docs/5.2/requests#old-input
    {
        $validator =  $this->validate($request, [
            'name' => 'required', // le nom du champ dans la bdd (voir les champ en dessous nom,prenom etc)
            'pk' => 'required', //le id de l'eleve dans la table
            'value' => 'required', // la valeur a modifier dans la table
            'name' => 'sometimes|required|',
            'prenom' => 'sometimes|required|',
            'adresse' => 'sometimes|required|',
            'telephone' => 'sometimes|required|phone:FR,US',
            'ville' => 'sometimes|required',
            'cp' => 'sometimes|required|between:2,10|alpha_num',
            'dob' => 'sometimes|required|date_format:d/m/Y',
        ]);

        if($validator) {
            return redirect(url()->previous()."#tab_1_3")
                ->withErrors($validator)
                ->withInput()->with("statut","bad");
        }
        $date="";
        if($request->input("name")=="dob")
        {
            $dateexplode = explode("/",$request->input("value"));
            $date = $dateexplode[2]."-".$dateexplode[1]."-".$dateexplode[0];
        }
        $user =User::find($request->input("pk"));
        if($date!="")$user->{$request->input("name")}=$date ;
        else
        $user->{$request->input("name")}=$request->input("value") ;
        $user->save();
        //si tout est ok. bdd et tout
        return redirect(url()->previous()."#tab_1_3")->with("statut","ok","msg","Les données ont bien été mis à jour"); //si c ok
        //sinon
        //return  redirect(url()->previous()."#tab_1_2")->with("statut","bad","msg","Erreur dans la bdd"); // si c bad
    }
}
