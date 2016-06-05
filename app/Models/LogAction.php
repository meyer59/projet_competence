<?php

namespace App\Models;
use Auth;
use DB;

class LogAction {

	public static $table = 'log_users';
	private static $limit = 20; // Nombre de logs à afficher par défaut

	/**
	 * Ajoute un log dans la base
	 *
	 * @param $action string 			add|update|delete|...
	 * @param $type string 				Element ou module concerné
	 * @param $info string 				Détails sur l'élément et l'utilisateur concerné
	 * @param $visibility int 			Niveau de visibilité dans l'interface : 0 = affiché, 1 = filtré (affichable par clic)
	 */
	public static function log($action, $type, $visibility = 0) {

		// Fonctionne avec la vue template master.blade.php, à voir pour une traduction mieux que celle-là
		// TODO: Améliorer ce système

		$request = DB::table(self::$table)
			->insert([
				'action' => $action,
				'text_action' => $type,
				'created_at' => date('Y/m/d H:i:s'),
				'visibility' => $visibility,
				'user_id' => Auth::user()->id
			]);
	}

	/**
	 * Retourne un nombre de logs donné, sinon la valeur par défaut
	 *
	 * @param $limit int 				Nombre de logs à afficher
	 * @return array(object)
	 */
	public static function show($id_users,$limit = null) {
		if(!$limit) $limit = self::$limit; // Si null, le paramètre de la classe est pris en compte

		return DB::table(self::$table)
			->where(['users_id' => $id_users])
			->orderBy('created_at', 'DESC')
			->limit($limit)
			->get();
	}
}