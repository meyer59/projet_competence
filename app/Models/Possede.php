<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Possede
 */
class Possede extends Model
{
    protected $table = 'possede';

    public $timestamps = false;

    protected $fillable = [
        'mention',
        'date_obtention',
        'id_diplome',
        'users_id'
    ];

    protected $guarded = [];

        
}