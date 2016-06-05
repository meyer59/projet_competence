<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Competence
 */
class Competence extends Model
{
    protected $table = 'competence';

    protected $primaryKey = 'id_competence';

	public $timestamps = false;

    protected $fillable = [
        'nom_competence',
        'libelle_competence',
        'id_groupeCompetence'
    ];

    protected $guarded = [];
	 public function selectionner_groupecompetence_competence($idmatiere) //$idmatiere
	{
                $sql = "SELECT nom_competence,id_competence
                            FROM competence
                            INNER JOIN groupe_competence ON groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                            WHERE groupe_competence.id_groupeCompetence = '".$idmatiere."'";  
                   $values = array();                  
                   $result = DB::select(DB::raw($sql)); 
                   foreach ($result as $groupe => $competence ) {                       
                           $values[$groupe] = $competence;            
                       }
                  return $values;       
                 
	}

    /**
     * @param $id_matiere
     * @return un tableau de toutes les competenes liees au groupe
     */
    public static function getAllCompetenceByGroupeCompetence($id_matiere)
    {
        $all_competence_query = DB::select("SELECT nom_competence,id_competence
                                            FROM competence
                                            INNER JOIN groupe_competence ON groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                                            WHERE groupe_competence.id_groupeCompetence = ?",
                                            array($id_matiere));
        $all_competence = array();
        foreach($all_competence_query as $competence)
        {
            $all_competence[$competence['id_competence']] = $competence['nom_competence'];
        }
        return $all_competence;
    }

    /**
     * @param $id_eleve
     * @param $id_competence
     * @param $interval
     * @return array all competence
     */
    public static function getEleveAutoEvalCompetence($id_eleve,$id_competence,$limit)
    {
            DB::select("SET time_zone = '+00:00';");
            $all_competence = DB::select("SELECT competence.id_competence,auto_evaluer.note_autoEval,
                                          (unix_timestamp(auto_evaluer.date_autoEval) * 1000) as timestamp,users.name
                                            FROM competence
                                            INNER JOIN auto_evaluer ON auto_evaluer.id_competence = competence.id_competence
                                            INNER JOIN users ON users.id = auto_evaluer.users_id
                                            WHERE users.id = ?
                                            AND auto_evaluer.date_autoEval >= '{$limit[0]} 00:00:00'
                                            AND auto_evaluer.date_autoEval <= '{$limit[1]} 00:00:00'
                                            AND competence.id_competence = ?
                                            ORDER BY auto_evaluer.date_autoEval
                                            ",[$id_eleve,$id_competence]);
            $data = array();
            foreach($all_competence as $competence)
            {
                $data[] = array(doubleval($competence['timestamp']),$competence['note_autoEval']);
            }
        if(!empty($data))
        {
            return [
                "name" => $all_competence[0]['name'],
                "type" =>"line",
                "data" => $data
            ];
        }
        else return [];

        }

    /**
     * @param $id_eleve
     * @param $id_competence
     * @param $limit
     * @param $id_prof
     * @return les evaluer simplement d'un prof pour un eleve et une competence
     */
    public static function getEleveEvaluerSimplementCompetence($id_eleve,$id_competence,$limit,$id_prof)
    {
        $all_competence = DB::select("SELECT competence.id_competence,evaluer_simplement.note_evaluerSimplement, (unix_timestamp(evaluer_simplement.date_evaluerSimplement) * 1000) as timestamp, 'Prof evaluer simplement' as name
                                            FROM competence
                                            INNER JOIN evaluer_simplement ON evaluer_simplement.id_competence = competence.id_competence
                                            INNER JOIN users eleve ON eleve.id = evaluer_simplement.users_id_eleve
                                            INNER JOIN users prof ON prof.id = evaluer_simplement.users_id_prof
                                            WHERE eleve.id = ?
                                            AND prof.id = ?
                                            AND evaluer_simplement.date_evaluerSimplement >= '{$limit[0]} 00:00:00'
                                            AND evaluer_simplement.date_evaluerSimplement <= '{$limit[1]} 00:00:00'
                                            AND competence.id_competence = ?
                                            ORDER BY evaluer_simplement.date_evaluerSimplement
                                            ",[$id_eleve,$id_prof,$id_competence]);
        $data = array();
        foreach($all_competence as $competence)
        {
            $data[] = array(doubleval($competence['timestamp']),$competence['note_evaluerSimplement']);
        }
        if(!empty($data)) {
            return [
                "name" => $all_competence[0]['name'],
                "type" =>"line",
                "data" => $data
            ];
        }
        else return [];

    }

    /**
     * @param $id_eleve
     * @param $id_competence
     * @param $limit
     * @param $id_prof
     * @return un array contenant toutes notes d'un prof pour un eleve et une competences
     */
    public static function getEleveEvaluerEpreuveCompetence($id_eleve,$id_competence,$limit,$id_prof)
    {
        $all_competence = DB::select("SELECT competence.id_competence,evaluer_avec_epreuve.note, (unix_timestamp(evaluer_avec_epreuve.date_eval) * 1000) as timestamp, 'Prof evaluer epreuve' as name
                                            FROM competence
                                            INNER JOIN evaluer_avec_epreuve ON evaluer_avec_epreuve.id_competence = competence.id_competence
                                            INNER JOIN users eleve ON eleve.id = evaluer_avec_epreuve.users_id_eleve
                                            INNER JOIN epreuve ON epreuve.id_epreuve = evaluer_avec_epreuve.id_epreuve
                                            INNER JOIN users prof ON epreuve.users_id = prof.id
                                            WHERE eleve.id = ?
                                            AND prof.id = ?
                                            AND evaluer_avec_epreuve.date_eval >= '{$limit[0]} 00:00:00'
                                            AND evaluer_avec_epreuve.date_eval <= '{$limit[1]} 00:00:00'
                                            AND competence.id_competence = ?
                                            ORDER BY evaluer_avec_epreuve.date_eval
                                            ",[$id_eleve,$id_prof,$id_competence]);
        $data = array();
        foreach($all_competence as $competence)
        {
            $data[] = array(doubleval($competence['timestamp']),$competence['note']);
        }
        if(!empty($data)) {
            return [
                "name" => $all_competence[0]['name'],
                "type" => "line",
                "data" => $data
            ];
        }
            else return [];
    }

    /**
     * @param $id_classe
     * @param $id_prof
     * @param $id_competence
     * @return un tableau avec pour le nombre d'eleve par note (EX: 5 => 11)
     */
    public static function getcountNoteCompetenceAutoEval($id_classe,$id_competence)
    {
        $all_competence_query = DB::select("SELECT COUNT(auto_evaluer.users_id) as count,
                                        CASE (auto_evaluer.note_autoEval)
                                          WHEN 1 THEN '1 - Non acquis'
                                          WHEN 2 THEN \"2 - En cours d'aquisition\"
                                          WHEN 3 THEN '3 - A renforcer'
                                          WHEN 4 THEN '4 - Acquis'
                                          WHEN 5 THEN '5 - Maîtrisé'
                                          END AS note
                                              FROM (SELECT MAX(auto_evaluer.note_autoEval) AS note_autoEval,auto_evaluer.users_id
                                                    FROM auto_evaluer
                                                    WHERE auto_evaluer.id_competence = {$id_competence}
                                                    GROUP BY auto_evaluer.users_id
                                                    ) auto_evaluer
                                              INNER JOIN
                                                (SELECT users.id
                                                    FROM users
                                                    INNER JOIN appartenir ON appartenir.users_id = users.id
                                                    INNER JOIN groupe ON groupe.id_groupe = appartenir.id_groupe
                                                    INNER JOIN annee ON  groupe.id_annee = annee.id_annee
                                                      WHERE NOW() BETWEEN annee.date_debut AND annee.date_fin
                                                      AND groupe.id_groupe = {$id_classe}
                                                 ) users ON users.id = auto_evaluer.users_id
                                                GROUP BY auto_evaluer.note_autoEval
                                                ");
        $all_competence = [];
        foreach($all_competence_query as $competence)
        {
            $all_competence[] = [$competence["note"],$competence["count"]];
        }
        return $all_competence;
    }

    /**
     * @param $id_classe
     * @param $id_competence
     * @param $id_prof
     * @return array les note d'evaluation simple d'un professeur pour une classe
     */
    public static function getcountNoteCompetenceEvalSimple($id_classe,$id_competence,$id_prof)
    {
        $all_competence_query = DB::select("SELECT COUNT(evaluer_simplement.users_id_eleve) as count,
                                        CASE (evaluer_simplement.note_evaluerSimplement)
                                          WHEN 1 THEN '1 - Non acquis'
                                          WHEN 2 THEN \"2 - En cours d'aquisition\"
                                          WHEN 3 THEN '3 - A renforcer'
                                          WHEN 4 THEN '4 - Acquis'
                                          WHEN 5 THEN '5 - Maîtrisé'
                                          END AS note
                                              FROM (SELECT MAX(evaluer_simplement.note_evaluerSimplement) AS note_EvaluerSimplement,evaluer_simplement.users_id_eleve,evaluer_simplement.users_id_prof
                                                    FROM evaluer_simplement
                                                    WHERE evaluer_simplement.id_competence = {$id_competence}
                                                    GROUP BY evaluer_simplement.users_id_eleve
                                                    ) evaluer_simplement
                                              INNER JOIN
                                                (SELECT users.id
                                                    FROM users
                                                    INNER JOIN appartenir ON appartenir.users_id = users.id
                                                    INNER JOIN groupe ON groupe.id_groupe = appartenir.id_groupe
                                                    INNER JOIN annee ON  groupe.id_annee = annee.id_annee
                                                      WHERE NOW() BETWEEN annee.date_debut AND annee.date_fin
                                                      AND groupe.id_groupe = {$id_classe}
                                                 ) eleve ON eleve.id = evaluer_simplement.users_id_eleve
                                                GROUP BY evaluer_simplement.note_evaluerSimplement
                                                ");
        $all_competence = [];
        foreach($all_competence_query as $competence)
        {
            $all_competence[] = [$competence["note"],$competence["count"]];
        }
        return $all_competence;
    }

    public static function getCountNoteEvalEpreuve($id_classe,$id_competence)
    {
        $all_competence_query = DB::select("SELECT COUNT(evaluer_avec_epreuve.users_id_eleve) as count,
                                        CASE (evaluer_avec_epreuve.note)
                                          WHEN 1 THEN '1 - Non acquis'
                                          WHEN 2 THEN \"2 - En cours d'aquisition\"
                                          WHEN 3 THEN '3 - A renforcer'
                                          WHEN 4 THEN '4 - Acquis'
                                          WHEN 5 THEN '5 - Maîtrisé'
                                          END AS note
                                              FROM (SELECT MAX(evaluer_avec_epreuve.note) AS note, evaluer_avec_epreuve.users_id_eleve
                                                    FROM evaluer_avec_epreuve
                                                    WHERE evaluer_avec_epreuve.id_competence = {$id_competence}
                                                    GROUP BY evaluer_avec_epreuve.users_id_eleve
                                                    ) evaluer_avec_epreuve
                                              INNER JOIN
                                                (SELECT users.id
                                                    FROM users
                                                    INNER JOIN appartenir ON appartenir.users_id = users.id
                                                    INNER JOIN groupe ON groupe.id_groupe = appartenir.id_groupe
                                                    INNER JOIN annee ON  groupe.id_annee = annee.id_annee
                                                      WHERE NOW() BETWEEN annee.date_debut AND annee.date_fin
                                                      AND groupe.id_groupe = {$id_classe}
                                                 ) eleve ON eleve.id = evaluer_avec_epreuve.users_id_eleve
                                                GROUP BY evaluer_avec_epreuve.note");
        $all_competence = [];
        foreach($all_competence_query as $competence)
        {
            $all_competence[] = [$competence["note"],$competence["count"]];
        }
        return $all_competence;
    }

    public static function getClassMatiere($class,$prof_id)
    {
        $all_matiere_query = DB::select("SELECT groupe_competence.nom_groupe
                                            FROM groupe_competence
                                            INNER JOIN matiere ON matiere.id_matiere = groupe_competence.id_matiere
                                            INNER JOIN intervient ON intervient.id_matiere = matiere.id_matiere
                                            INNER JOIN users ON users.id = intervient.users_id
                                            INNER JOIN suivre ON suivre.id_matiere = matiere.id_matiere
                                            INNER JOIN groupe ON groupe.id_groupe = suivre.id_groupe
                                            INNER JOIN annee ON groupe.id_annee = annee.id_annee
                                              WHERE users.id = ?
                                              AND groupe.id_groupe = ?
                                              AND NOW() BETWEEN annee.date_debut AND annee.date_fin",
                                              array($prof_id,$class));
        $all_matiere = array();
        foreach($all_matiere_query as $matiere)
        {
            $all_matiere[] = $matiere["nom_groupe"];
        }
        return $all_matiere;
    }

    public static function getCompetenceByClass($class,$prof_id)
    {
        $all_matiere = DB::select("SELECT groupe_competence.nom_groupe,groupe_competence.id_groupeCompetence
                                            FROM groupe_competence
                                            INNER JOIN matiere ON matiere.id_matiere = groupe_competence.id_matiere
                                            INNER JOIN intervient ON intervient.id_matiere = matiere.id_matiere
                                            INNER JOIN users ON users.id = intervient.users_id
                                            INNER JOIN suivre ON suivre.id_matiere = matiere.id_matiere
                                            INNER JOIN groupe ON groupe.id_groupe = suivre.id_groupe
                                            INNER JOIN annee ON groupe.id_annee = annee.id_annee
                                              WHERE users.id = ?
                                              AND groupe.id_groupe = ?
                                              AND NOW() BETWEEN annee.date_debut AND annee.date_fin",
                                                array($prof_id,$class));

        $matiere_retour = [];
        foreach($all_matiere as $matiere)
        {
            $all_competence = [];
            $competence_array = self::getCompetenceByMatiere($matiere['id_groupeCompetence']);
            foreach($competence_array as $competence)
            {
                $all_competence[$competence['id_competence']] = $competence['nom_competence'];
            }
            $matiere_retour[$matiere["nom_groupe"]] =  $all_competence ;
        }
        return $matiere_retour;
    }

    public static function getCompetenceByMatiere($id_matiere)
    {
        $all_competence = DB::select("SELECT competence.* FROM competence
                                      INNER JOIN groupe_competence ON groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                                      WHERE groupe_competence.id_groupeCompetence = ?",
                                      array($id_matiere));
        return $all_competence;
    }


        
}