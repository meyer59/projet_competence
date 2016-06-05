<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Annee
 */
class Annee extends Model
{
    protected $table = 'annee';

    protected $primaryKey = 'id_annee';

	public $timestamps = false;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'intitule'
    ];

    protected $guarded = [];

        
}