<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login','UsersController@authenticate');

//CHECKLIST
$router->get('/checklists', 'ChecklistController@getChecklist');
$router->post('/checklists', 'ChecklistController@createChecklist');
$router->patch('/checklists/{checklistID}', 'ChecklistController@updateChecklist');
$router->delete('/checklists/{checklistID}', 'ChecklistController@deleteChecklist');

//ITEMS
$router->get('/checklists/{checklistID}/items', 'ItemController@getdata');
$router->post('/checklists/{checklistID}/items', 'ItemController@createdata');

$router->get('/test', 'ChecklistController@test');

