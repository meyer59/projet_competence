<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use View;

/**
 * Class Diplome
 */
class Diplome extends Model
{
    protected $table = 'diplome';
    protected $primaryKey = 'id_diplome';
    public $timestamps = false;
    protected $fillable = [
        'nom_diplome',
        'niveau_diplome'
    ];
    protected $guarded = [];
    /**
     * Recupere tous les diplomes (nom, niveau, mention) d'un eleve 
     * @param type $iduser
     * @return type
     */
          public function afficher_diplome($iduser) // recuperer iduser 
	{  
                 $sql = "SELECT diplome.niveau_diplome, diplome.nom_diplome, CONCAT(upper(left(possede.mention ,1)),lower(right(possede.mention, length(possede.mention)-1))) as mention
                        FROM diplome
                        inner join possede ON possede.id_diplome = diplome.id_diplome
                        inner join users ON users.id = possede.users_id
                        where users.id = '$iduser'
                        order by diplome.niveau_diplome asc "; 
            $result = DB::select(DB::raw($sql));
        $values=array();
                     foreach ($result as $note_cle ) { 
                           $diplomeencours = $note_cle['nom_diplome']; 
                           $iddiplomeencours = $note_cle['niveau_diplome'];
                           $mentionencours = $note_cle['mention'];
                          $values[$iddiplomeencours] = array( $diplomeencours => $mentionencours);                         
                       }
               return $values;     
	}     
}