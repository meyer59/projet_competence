<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contenir
 */
class Contenir extends Model
{
    protected $table = 'contenir';

    public $timestamps = false;

    protected $fillable = [
        'id_epreuve',
        'id_competence'
    ];

    protected $guarded = [];

        
}