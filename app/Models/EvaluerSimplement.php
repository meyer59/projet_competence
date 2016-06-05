<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluerSimplement
 */
class EvaluerSimplement extends Model
{
    protected $table = 'evaluer_simplement';

    public $timestamps = false;

    protected $fillable = [
        'note_evaluerSimplement',
        'date_EvaluerSimplement',
        'id_competence',
        'users_id_prof',
        'users_id_eleve'
    ];

    protected $guarded = [];

        
}