<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class GroupeCompetence
 */
class GroupeCompetence extends Model
{
    protected $table = 'groupe_competence';

    protected $primaryKey = 'id_groupeCompetence';

	public $timestamps = false;

    protected $fillable = [
        'nom_groupe',
        'libele_groupe',
        'id_matiere'
    ];

    protected $guarded = [];

}