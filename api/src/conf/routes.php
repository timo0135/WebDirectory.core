<?php
declare(strict_types=1);

use webDirectory\api\app\actions\GetDepartements;
use webDirectory\api\app\actions\GetDepartementsAction;
use webDirectory\api\app\actions\GetDepartementsById;
use webDirectory\api\app\actions\GetDepartementsByIdAction;

return function( \Slim\App $app): \Slim\App {
    
    // 7) Route pour récupérer la liste des départements
    $app->get('/api/services',
        GetDepartementsAction::class
        )->setName('api/services');

    // Route pour récupérer un département par son id
    $app->get('/api/services/{id}',
        GetDepartementsByIdAction::class
        )->setName('api/services/{id}');


    
    return $app;

};
