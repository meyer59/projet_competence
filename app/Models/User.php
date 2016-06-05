<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;


/**
 * Class User
 */
class User extends Model
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'remember_token',
        'nom',
        'prenom'
    ];

    protected $guarded = [];

    /**
     * retourne toutes les classes dans lesquelles un professeur intervient
     * @param $prof_id l'id du professeur dans la table users
     */
    public static function getProfClasses($prof_id)
    {
        return  DB::select('SELECT DISTINCT COUNT(appartenir.id_groupe) AS nb_eleves,groupe.id_groupe AS classeId,groupe.nom_groupe AS nom_classe
                    FROM groupe
                    INNER JOIN suivre ON suivre.id_groupe = groupe.id_groupe
                    INNER JOIN matiere ON matiere.id_matiere = suivre.id_matiere
                    INNER JOIN intervient ON intervient.id_matiere = matiere.id_matiere
                    INNER JOIN users ON intervient.users_id = users.id
                    INNER JOIN appartenir ON appartenir.id_groupe = groupe.id_groupe
                    INNER JOIN annee ON annee.id_annee = groupe.id_annee
                    WHERE users.id = ?
                    AND NOW() BETWEEN annee.date_debut AND annee.date_fin
                    GROUP BY 2,3,intervient.id',[$prof_id]);

    }

    /** retourne les 20 derniere note que un professeur à mise pour des evaluations avec epreuve
     * @param $prof_id
     * @return mixed
     */
    public static function getLastNoteEpreuve($prof_id)
    {
        return  DB::select("SELECT competence.nom_competence as competence, DATE_FORMAT(evaluer_avec_epreuve.date_eval,'%d/%m/%Y') AS date_note,groupe_competence.nom_groupe AS matiere, CONCAT(UPPER(SUBSTRING(eleve.name,1,1)) ,'.', eleve.prenom) as nom_eleve,evaluer_avec_epreuve.note
                                    FROM evaluer_avec_epreuve
                                    INNER JOIN epreuve ON epreuve.id_epreuve = evaluer_avec_epreuve.id_epreuve
                                    INNER JOIN users prof ON epreuve.users_id = prof.id
                                    INNER JOIN users eleve ON eleve.id = evaluer_avec_epreuve.users_id_eleve
                                    INNER JOIN competence ON competence.id_competence = evaluer_avec_epreuve.id_competence
                                    INNER JOIN groupe_competence ON groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                                    WHERE prof.id = ?
                                    LIMIT 10
                                    ",[$prof_id]);
    }

    public static function getcountNoteCompetenceAutoEvalDetail($id_classe,$id_competence,$note)
    {
        $all_competence_query = DB::select("select users.name as nom,users.prenom,groupe_competence.nom_groupe as matiere,competence.nom_competence as competence,{$note} as note,auto_evaluer.date_autoEval as date
                                            from auto_evaluer
                                            INNER join users on auto_evaluer.users_id = users.id
                                            inner join competence on competence.id_competence = auto_evaluer.id_competence
                                            inner join groupe_competence on groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                                            inner join matiere on matiere.id_matiere = groupe_competence.id_matiere
                                            inner join suivre on suivre.id_matiere = matiere.id_matiere
                                            inner join groupe on suivre.id_groupe = groupe.id_groupe
                                            inner join annee on annee.id_annee = groupe.id_annee
                                            Where auto_evaluer.id_competence = {$id_competence}
                                            and groupe.id_groupe = {$id_classe}
                                            and NOW() BETWEEN annee.date_debut and annee.date_fin
                                            group by auto_evaluer.users_id
                                            HAVING max(auto_evaluer.note_autoEval) = {$note}
                                                ");
       return $all_competence_query;
    }

    public static function getcountNoteCompetenceEvalSimpleDetail($id_classe,$id_competence,$note)
    {
        $all_competence_query = DB::select("select users.name as nom,users.prenom,groupe_competence.nom_groupe as matiere,competence.nom_competence as competence,{$note} as note,evaluer_simplement.date_evaluerSimplement as date
                                            from evaluer_simplement
                                            INNER join users on evaluer_simplement.users_id_eleve = users.id
                                            inner join competence on competence.id_competence = evaluer_simplement.id_competence
                                            inner join groupe_competence on groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                                            inner join matiere on matiere.id_matiere = groupe_competence.id_matiere
                                            inner join suivre on suivre.id_matiere = matiere.id_matiere
                                            inner join groupe on suivre.id_groupe = groupe.id_groupe
                                            inner join annee on annee.id_annee = groupe.id_annee
                                            Where evaluer_simplement.id_competence = {$id_competence}
                                            and groupe.id_groupe = {$id_classe}
                                            and NOW() BETWEEN annee.date_debut and annee.date_fin
                                            group by evaluer_simplement.users_id_eleve
                                            HAVING max(evaluer_simplement.note_evaluerSimplement) = {$note}
                                                ");
        return $all_competence_query;
    }
    public static function getcountNoteEvalEpreuveDetail($id_classe,$id_competence,$note){
        $all_competence_query = DB::select("select users.name as nom,users.prenom,groupe_competence.nom_groupe as matiere,competence.nom_competence as competence,{$note} as note,evaluer_avec_epreuve.date_eval as date
                                            from evaluer_avec_epreuve
                                            INNER join users on evaluer_avec_epreuve.users_id_eleve = users.id
                                            inner join competence on competence.id_competence = evaluer_avec_epreuve.id_competence
                                            inner join groupe_competence on groupe_competence.id_groupeCompetence = competence.id_groupeCompetence
                                            inner join matiere on matiere.id_matiere = groupe_competence.id_matiere
                                            inner join suivre on suivre.id_matiere = matiere.id_matiere
                                            inner join groupe on suivre.id_groupe = groupe.id_groupe
                                            inner join annee on annee.id_annee = groupe.id_annee
                                            Where evaluer_avec_epreuve.id_competence = {$id_competence}
                                            and groupe.id_groupe = {$id_classe}
                                            and NOW() BETWEEN annee.date_debut and annee.date_fin
                                            group by evaluer_avec_epreuve.users_id_eleve
                                            HAVING max(evaluer_avec_epreuve.note) = {$note}
                                            ");
        return $all_competence_query;
    }

}