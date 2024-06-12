<?php
declare(strict_types=1);
use webDirectory\api\app\actions;

return function( \Slim\App $app): \Slim\App {

    $app->get('/entrees',actions\GetEntreesAction::class)->setName('entrees');

    return $app;

};
