<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use View;
/**
 * Class AutoEvaluer
 */
class AutoEvaluer extends Model
{
    protected $table = 'auto_evaluer';
    public $timestamps = false;
    protected $fillable = [
        'date_autoEval',
        'note_autoEval',
        'id_competence',
        'users_id',
        'commentaire'
    ];
    protected $guarded = [];
        /**
         * Ajoute dans la bdd chaque auto evaluation
         * @param type $date
         * @param type $radio_note
         * @param type $idcompetence
         * @param type $iduser
         * @param type $commentaire
         */
        public function ajouter_auto_evaluation($date,$radio_note, $idcompetence, $iduser, $commentaire) 
	{
               $sql = "INSERT INTO `projet_competence`.`auto_evaluer` (`id`, `date_autoEval`, `note_autoEval`, `id_competence`, `users_id`, `commentaire`) VALUES (NULL, '$date', '$radio_note', '$idcompetence', '$iduser', '$commentaire');";
                DB::insert(DB::raw($sql));
	}
        /**
         * recupere toute les auto-evaluations faite par un eleve particulié
         * @param type $iduser
         * @return type
         */
        public function afficher_autoEval($iduser)
	{       
             // $sql = "select * from auto_evaluer where auto_evaluer.users_id = '$iduser' order by auto_evaluer.date_autoEval desc";
              $sql = "select * 
                    from( SELECT groupe_competence.nom_groupe, auto_evaluer.date_autoEval, auto_evaluer.note_autoEval, auto_evaluer.id_competence, auto_evaluer.users_id, auto_evaluer.commentaire from auto_evaluer inner join competence on competence.id_competence = auto_evaluer.id_competence inner join groupe_competence on groupe_competence.id_groupeCompetence = competence.id_groupeCompetence where auto_evaluer.users_id = '$iduser' order by auto_evaluer.id desc) as cptp 
                    group by id_competence";
              
                $values = array();
                $result = DB::select(DB::raw($sql));              
                      foreach ($result as $note_cle ) { 
                          $nomgroupecompetence = $note_cle['nom_groupe'];
                          $nomcompetence = $this->getnomcompetence($note_cle['id_competence']);
                          $note_cle['nom_competence'] = $nomcompetence;
                          $values[] = $note_cle;                         
                       }
                  return $values;                 
	}        
        /**
         * recupere le nom d'une competence correspondant un id_competence defini
         * @param type $idcompetence
         * @return type
         */
        public function getnomcompetence($idcompetence){           
            $sql = "select nom_competence from competence where competence.id_competence = '$idcompetence'";          
            $result = DB::select(DB::raw($sql));           
            return $result[0]['nom_competence'];
        }        
}