<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diplome;
use App\Models\AutoEvaluer;
use App\Models\Competence;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use View;

class diplomeController extends Controller
{
 /**
  * Envoi a la view diplome tous les diplomes d'un eleve
  * @return type
  */
    public function recupereDiplomeUser(){
        $iduser = Auth::user()->id;
        $diplome = new Diplome;
        $diplomeselectionne = $diplome->afficher_diplome($iduser);
        $resultdiplome = $diplomeselectionne;     
        return view('layouts/eleve/diplome', compact('resultdiplome'));
     }
}