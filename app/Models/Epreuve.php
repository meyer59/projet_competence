<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Epreuve
 */
class Epreuve extends Model
{
    protected $table = 'epreuve';

    protected $primaryKey = 'id_epreuve';

	public $timestamps = false;

    protected $fillable = [
        'date_epreuve',
        'users_id'
    ];

    protected $guarded = [];

        
}