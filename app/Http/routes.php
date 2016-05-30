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

    //Route::get('/', 'HomeController@index');
     Route::auth();
    Session::put('id_prof', 1);
//    Route::get('/', function () {
//        return view('login2');
//    });
    //********************ROUTE PROF**************************/
    //acceuil du prof
    Route::get('/prof/{n}/index', "Prof_index@getIndex")->where('n','\d+');
    Route::get('/prof/{n}/eval', "Prof_index@getEval")->where('n','\d+');
    Route::get('/prof/{n}/rapport', "Prof_index@getRapport")->where('n','\d+');
    Route::get('/prof/{n}/profile', "Prof_index@getProfile")->where('n','\d+');

    //creation des formulaires
    //Route::get('/prof/{n}/creation_form', "Prof_creationForm@index")->where('n','\d+');
    Route::get('/prof/getcompetence', "Prof_index@getcompetencejson");
    Route::get('/prof/detail_classe', "Prof_index@detail_classe");
    Route::post('/prof/editProfil', "Prof_index@postEditProfil");
    Route::get('/prof/graph_comparaisonProfEleve', "Prof_index@graph_comparaisonProfEleve");
    Route::get('/prof/graph_comparaisonEleveEleve', "Prof_index@graph_comparaisonEleveEleve");
    Route::get('/prof/graph_DetailEleve', "Prof_index@graph_DetailEleve");
    Route::get('/prof/getcompetenceByMatiere', "Prof_index@getcompetenceByMatierejson");
    Route::get('/prof/geteleve', "Prof_index@eleveenjson");
    Route::get('/prof/eleveEtmatiereEnjson', "Prof_index@eleveEtmatiereEnjson");
    Route::post('/prof/postcomptence', "Prof_index@postcomptence");
    //*****************FIN ROUTE PROF************************/
});
