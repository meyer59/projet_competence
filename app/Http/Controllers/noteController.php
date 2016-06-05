<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diplome;
use App\Models\AutoEvaluer;
use App\Models\Competence;
use App\Models\Epreuve;
use App\Models\Matiere;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use View;

class noteController extends Controller
{
        /**
         * Affiche dans la view diplome toute les note d'un eleve (auto evolution, evaluation professeur)
         * @return type
         */
        public function afficherNote(){
            $iduser =Auth::user()->id;
            $noteA = new AutoEvaluer;
            $noteAutoEvaluation= $noteA->afficher_autoEval($iduser);     
            $noteP = new Epreuve;
            $noteProfesseur= $noteP->afficher_epreuveProfesseur($iduser);       
            $resultnote= array();
            
            $touslesgroupe = new Matiere;
            $groupe= $touslesgroupe->selectionner_toute_matiere($iduser);
            
            $resultnote[0] = $groupe; 
            $resultnote[1] = $noteAutoEvaluation; 
            $resultnote[2] = $noteProfesseur;   
            return view('layouts/eleve/visualisation', compact('resultnote'));
        }
}