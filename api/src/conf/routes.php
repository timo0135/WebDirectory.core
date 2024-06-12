<?php
declare(strict_types=1);

return function( \Slim\App $app): \Slim\App {

    $app->get('/api/departements/{id}', \webDirectory\api\app\actions\GetEntreeByID::class)->setName('departement');

    return $app;

};
