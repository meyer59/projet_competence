<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Groupe
 */
class Groupe extends Model
{
    protected $table = 'groupe';

    protected $primaryKey = 'id_groupe';

	public $timestamps = false;

    protected $fillable = [
        'nom_groupe',
        'id_annee',
        'id_diplome'
    ];

    protected $guarded = [];

    public static function getNomClassById($id_classe)
    {
        return Groupe::findOrFail($id_classe)->nom_groupe;
    }

    public static function getAllEleveGroupe($id_groupe)
    {
        $all_users =  DB::select("SELECT users.id as id_eleve,users.name as nom,users.prenom, users.adresse, users.ville,users.cp as cp, users.telephone,users.dob
                           FROM users
                           INNER join appartenir on appartenir.users_id = users.id
                           INNER JOIN groupe ON groupe.id_groupe = appartenir.id_groupe
                           INNER JOIN annee ON annee.id_annee = groupe.id_annee
                           WHERE groupe.id_groupe = ?
                           AND NOW() BETWEEN annee.date_debut AND annee.date_fin",array($id_groupe));
        return $all_users;
    }

}