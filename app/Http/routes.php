<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    //Route moché
    Route::auth();
    Route::get('/check_role','HomeController@redirect');
    Route::get('/deconnexion','HomeController@logout');
    Route::get('/', 'HomeController@index');
    //********************ROUTE PROF**************************/
    //route restreinte pour les utilisateur authentifié
    Route::group(['middleware' => ['auth']], function () {
            //route restreint pour les professeurs
            Route::group(['middleware' => ['prof']], function () {
                //acceuil du prof
                Route::get('/prof/index', "Prof_index@getIndex")->name('prof_index');
                Route::get('/prof/eval', "Prof_index@getEval");
                Route::get('/prof/rapport', "Prof_index@getRapport");
                Route::get('/prof/profile', "Prof_index@getProfile");

                //creation des formulaires
                //Route::get('/prof/{n}/creation_form', "Prof_creationForm@index")->where('n','\d+');
                Route::get('/prof/getcompetence', "Prof_index@getcompetencejson");
                Route::get('/prof/detail_classe', "Prof_index@detail_classe");
                Route::post('/prof/editProfil', "Prof_index@postEditProfil");
                Route::get('/prof/graph_comparaisonProfEleve', "Prof_index@graph_comparaisonProfEleve");
                Route::get('/prof/graph_comparaisonEleveEleve', "Prof_index@graph_comparaisonEleveEleve");
                Route::get('/prof/graph_DetailEleve', "Prof_index@graph_DetailEleve");
                Route::get('/prof/getcompetenceByMatiere', "Prof_index@getcompetenceByMatierejson");
                Route::post('/prof/editProfilPhoto', "Prof_index@editProfilPhoto");
                Route::post('/prof/editProfilpassword', "Prof_index@editProfilpassword");
                Route::get('/prof/geteleve', "Prof_index@eleveenjson");
                Route::get('/prof/eleveEtmatiereEnjson', "Prof_index@eleveEtmatiereEnjson");
                Route::post('/prof/postcomptence', "Prof_index@postcomptence");
                Route::get('/prof/tab_competNonEval', "Prof_index@tab_competNonEval");

                //CSRF exlus
                Route::post('/prof/updateEleve', "Prof_index@updateEleve"); // pour le plug in xeditable de mise a jour des eleves
               // Route::post('/prof/graph_DetailEleveProf', "Prof_index@graph_DetailEleveProf");
                //*****************FIN ROUTE PROF************************/
        });
    });
});
