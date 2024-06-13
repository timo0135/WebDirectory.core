<?php
declare(strict_types=1);

use webDirectory\api\app\actions\GetDepartements;
use webDirectory\api\app\actions\GetDepartementsAction;
use webDirectory\api\app\actions\GetDepartementsById;
use webDirectory\api\app\actions\GetDepartementsByIdAction;
use webDirectory\api\app\actions\GetEntreesBySearchAction;
use webDirectory\api\app\actions\GetEntreesAction;
use webDirectory\api\app\actions\GetEntreeByID;

return function( \Slim\App $app): \Slim\App {

    // 7) Route pour récupérer la liste des départements
    $app->get('/api/services',
        GetDepartementsAction::class
        )->setName('api/services');
    //Route pour récupérer les entrées
    $app->get('/api/entrees',GetEntreesAction::class)->setName('entrees');
    // Route pour récupérer un département par son id
    $app->get('/api/services/{id}',
        GetDepartementsByIdAction::class
        )->setName('api/services/{id}');

    // 11) Route pour récupérer les entrées correspondant à une recherche
    $app->get('/api/entrees/search',
        GetEntreesBySearchAction::class
        )->setName('api/entrees/search');
    $app->get('/api/entrees/{id}', GetEntreeByID::class)->setName('departement');

    return $app;

};
