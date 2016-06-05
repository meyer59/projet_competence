<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CommantaireCompetence
 */
class CommantaireCompetence extends Model
{
    protected $table = 'commantaire_competence';

    protected $primaryKey = 'id_commentaireCompetence';

	public $timestamps = false;

    protected $fillable = [
        'commentaire',
        'id_competence'
    ];

    protected $guarded = [];

        
}