<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use View;
/**
 * Class Matiere
 */
class Matiere extends Model
{
    protected $table = 'matiere';
    protected $primaryKey = 'id_matiere';
    public $timestamps = false;
    protected $fillable = [
        'nom_matiere'
    ];
    protected $guarded = [];
    /**
     * recupere toute les matieres du groupe qui contient un eleve
     * @param type $iduser
     * @return type
     */
    public function selectionner_toute_matiere($iduser) // recuperer id user 
	{
                  $sql = "SELECT groupe_competence.nom_groupe,groupe_competence.id_groupeCompetence
                       FROM groupe_competence
                       INNER JOIN matiere ON matiere.id_matiere = groupe_competence.id_matiere
                       INNER JOIN suivre ON suivre.id_matiere = matiere.id_matiere
                       INNER JOIN groupe ON groupe.id_groupe = suivre.id_groupe
                       INNER JOIN annee ON annee.id_annee = groupe.id_annee
                       INNER JOIN appartenir ON appartenir.id_groupe = groupe.id_groupe
                       INNER JOIN users ON users.id = appartenir.users_id
                       WHERE annee.date_debut < now()
                       AND annee.date_fin > now()
                       AND users.id = '$iduser'";                    
                   $values = array();
                   $result = DB::select(DB::raw($sql));
                      foreach ($result as $matiere_cle ) {                                                 
                           $matiereencours = $matiere_cle['nom_groupe']; 
                           $idmatiereencours = $matiere_cle['id_groupeCompetence'];  
                           $values[$idmatiereencours] = $matiereencours;
                       }
                  return $values;
	}   
}