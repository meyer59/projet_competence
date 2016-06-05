<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 */
class Contact extends Model
{
    protected $table = 'contact';

    protected $primaryKey = 'id_contact';

	public $timestamps = false;

    protected $fillable = [
        'nom_contact',
        'prenom_contact',
        'adrese_contact',
        'CP_contact',
        'ville_contact',
        'telFixe_contact',
        'telMobile_contact'
    ];

    protected $guarded = [];

        
}