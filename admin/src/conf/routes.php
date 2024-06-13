<?php
declare(strict_types=1);


use webDirectory\admin\app\actions\GetCreateEntreeAction;
use webDirectory\admin\app\actions\PostCreateEntreeAction;

return function(\Slim\App $app): \Slim\App {

    $app->get('/entrees/create', GetCreateEntreeAction::class)->setName('entrees.create');

    $app->post('/entrees/create', PostCreateEntreeAction::class)->setName('entrees.create.post');

    return $app;

};
