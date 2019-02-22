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

//CHECKLIST
$router->get('/checklists/{checklistID}', 'ChecklistController@getChecklist');
$router->post('/checklists', 'ChecklistController@createChecklist');
$router->patch('/checklists/{checklistID}', 'ChecklistController@updateChecklist');
$router->delete('/checklists/{checklistID}', 'ChecklistController@deleteChecklist');

//ITEMS
$router->get('/checklists/{checklistID}/items', 'ChecklistController@getViaChecklistID');
$router->post('/checklists/{checklistID}/items', 'ChecklistController@postViaChecklistID');

