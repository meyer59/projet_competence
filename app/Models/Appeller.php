<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appeller
 */
class Appeller extends Model
{
    protected $table = 'appeller';

    public $timestamps = false;

    protected $fillable = [
        'id_contact',
        'users_id'
    ];

    protected $guarded = [];

        
}