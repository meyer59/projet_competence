<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\AutoEvaluer;
use App\Models\Competence;
use Illuminate\Support\Facades\Auth;
use View;

class evaluationController extends Controller
{
        /**
         * Envoi a la view evaluation toute les matieres d'un eleve
         * @return type
         */
        public function index()
	{
                $iduser =  Auth::user()->id;
                $retourneMatiere = new Matiere;
                $matiereselectionne = $retourneMatiere->selectionner_toute_matiere($iduser);
                $resultmatiere = array();
                $resultmatiere[0]=$matiereselectionne; 

                return view('layouts/eleve/evaluation', compact('resultmatiere'));
	}
        /**
         * Methode utilisé par getcompetencejson, renvoi les competence d'une matiere
         * @param type $idmatiere
         * @return type
         */
        public function competence($idmatiere)
	{
                $retourneGroupeCompetence = new Competence;
                $groupe_competence = $retourneGroupeCompetence->selectionner_groupecompetence_competence($idmatiere);
                return $groupe_competence;
	}
        /**
         * Renvoi les competence d'un groupe selon un groupe selectionné
         * @param type $idmatiere
         * @return type
         */
        public function getcompetencejson($idmatiere)
        {
                $cac = new evaluationController;
                $groupe_competence = $cac->competence($idmatiere);
                return response()->json(["groupe_competence"=>$groupe_competence]);
        }
        /**
         * retourne la view "informe l'eleve que le formulaire a bien été envoyé"
         * @return type
         */
        public function renvoiView(){
            return view('layouts/eleve/evaluation_form_valider');
        }
        /**
         * Cette methode recupere en POST le formulaire de l'eleve et l'ajoute dans la bdd
         * @param Request $request
         * @return type
         */
        public function formulairevalider(Request $request){
            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d");
            $iduser = Auth::user()->id;
            foreach($request->request as $cle => $value)
            {
               $idcomp = substr_replace ( $cle, "", 0, 6 );
                if( $cle == "radio_".$idcomp)
                {
                   $param = "com_".$idcomp;
                   $commentaire = $request->$param;
                   
                   $validerform = new AutoEvaluer;
                   $validerform->ajouter_auto_evaluation($date,$value, $idcomp, $iduser, $commentaire);                  
                }
            }            
           return view('layouts/eleve/evaluation_form_valider');
        }
}