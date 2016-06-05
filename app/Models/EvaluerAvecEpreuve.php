<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluerAvecEpreuve
 */
class EvaluerAvecEpreuve extends Model
{
    protected $table = 'evaluer_avec_epreuve';

    public $timestamps = false;

    protected $fillable = [
        'date_eval',
        'note',
        'id_competence',
        'id_epreuve',
        'users_id_eleve'
    ];

    protected $guarded = [];

        
}