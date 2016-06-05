<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Appartenir
 */
class Appartenir extends Model
{
    protected $table = 'appartenir';

    public $timestamps = false;

    protected $fillable = [
        'date_changement',
        'id_groupe',
        'users_id'
    ];

    protected $guarded = [];

    /**
     * @param $id_groupe
     * @return $all_eleve un tableau contenant tous les eleves d'un groupe
     */
    public static function getEleveGroupe($id_groupe)
    {
        $all_eleve_query = DB::select("SELECT users.id, users.name
                                       FROM users
                                       INNER JOIN appartenir ON appartenir.users_id = users.id
                                       INNER JOIN groupe ON appartenir.id_groupe = groupe.id_groupe
                                       INNER JOIN annee ON annee.id_annee = groupe.id_annee
                                       WHERE groupe.id_groupe = ?"
                                        ,array($id_groupe));
        $all_eleve = array();
        foreach($all_eleve_query AS $eleve)
        {
            $all_eleve[$eleve['id']] = $eleve['name'];
        }
        return $all_eleve;
    }
}