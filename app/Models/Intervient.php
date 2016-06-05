<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Intervient
 */
class Intervient extends Model
{
    protected $table = 'intervient';

    public $timestamps = false;

    protected $fillable = [
        'id_intervenant',
        'id_matiere',
        'users_id'
    ];

    protected $guarded = [];

    /**
     * @param $prof_id
     * retourne un tableau avec comme cllé l'id de la classe et comme valeur le nom de la classe
     */
    public static function getProfClass($prof_id)
    {
        $all_classe_db = DB::select("SELECT groupe.id_groupe,nom_groupe FROM groupe
                                INNER JOIN suivre ON suivre.id_groupe = groupe.id_groupe
                                INNER JOIN matiere ON matiere.id_matiere = suivre.id_matiere
                                INNER JOIN intervient ON intervient.id_matiere = matiere.id_matiere
                                INNER JOIN users ON intervient.users_id = users.id
                                INNER JOIN annee ON annee.id_annee = groupe.id_annee
                                WHERE users.id = ?
                                AND NOW() BETWEEN annee.date_debut AND annee.date_fin",
                                array($prof_id));
        $all_classe = array();
        foreach($all_classe_db as $classe)
        {
            $all_classe[$classe['id_groupe']] = $classe['nom_groupe'];
        }
        return $all_classe;
    }

    /**
     * @param $prof_id
     * @param $classe_id
     * @return bool true si le proffesseur intervient pour le groupe else sinon
     */
    public static function ProfIntervientClass($prof_id,$classe_id)
    {
        $prof_intervient = DB::select("SELECT COUNT(groupe.id_groupe) AS intervient FROM groupe
                                INNER JOIN suivre ON suivre.id_groupe = groupe.id_groupe
                                INNER JOIN matiere ON matiere.id_matiere = suivre.id_matiere
                                INNER JOIN intervient ON intervient.id_matiere = matiere.id_matiere
                                INNER JOIN users ON intervient.users_id = users.id
                                INNER JOIN annee ON annee.id_annee = groupe.id_annee
                                WHERE users.id = ?
                                AND NOW() BETWEEN annee.date_debut AND annee.date_fin
                                AND groupe.id_groupe = ?",
            array($prof_id,$classe_id));

        return $prof_intervient[0]['intervient'] ? true : false;
    }

    public static function getMatiereGroupeProf($id_prof,$id_groupe)
    {
        $all_matiere_query = DB::select("SELECT groupe_competence.nom_groupe, groupe_competence.id_groupeCompetence
                                         FROM groupe_competence
                                         INNER JOIN matiere ON groupe_competence.id_matiere = matiere.id_matiere
                                         INNER JOIN intervient ON intervient.id_matiere = matiere.id_matiere
                                         INNER JOIN users ON users.id = intervient.users_id
                                         INNER JOIN suivre ON suivre.id_matiere = matiere.id_matiere
                                         INNER JOIN groupe ON groupe.id_groupe = suivre.id_groupe
                                         INNER JOIN annee ON groupe.id_annee = annee.id_annee
                                         WHERE NOW() BETWEEN annee.date_debut AND annee.date_fin
                                         AND users.id = ?
                                         AND groupe.id_groupe = ?
                                         ",array($id_prof,$id_groupe));
        $all_matiere = array();
        foreach($all_matiere_query as $matiere){
            $all_matiere[$matiere['id_groupeCompetence']] = $matiere['nom_groupe'];
        }
        return $all_matiere;
    }



}