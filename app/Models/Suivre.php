<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Suivre
 */
class Suivre extends Model
{
    protected $table = 'suivre';

    public $timestamps = false;

    protected $fillable = [
        'id_groupe',
        'id_matiere'
    ];

    protected $guarded = [];

        
}