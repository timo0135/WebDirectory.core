<?php
declare(strict_types=1);


use webDirectory\admin\app\actions\GetConnectionAction;
use webDirectory\admin\app\actions\GetCreateEntreeAction;
use webDirectory\admin\app\actions\GetCreateServiceAction;
use webDirectory\admin\app\actions\GetEntreesAction;
use webDirectory\admin\app\actions\GetEntreesForOneServiceAction;
use webDirectory\admin\app\actions\PostConnectionAction;
use webDirectory\admin\app\actions\PostCreateEntreeAction;
use webDirectory\admin\app\actions\PostCreateServiceAction;

return function(\Slim\App $app): \Slim\App {

    $app->get('/entrees', GetEntreesAction::class)->setName('entrees');

    $app->get('/entrees/create', GetCreateEntreeAction::class)->setName('entrees.create');

    $app->post('/entrees/create', PostCreateEntreeAction::class)->setName('entrees.create.post');

    $app->get('/services/{id}/entrees', GetEntreesForOneServiceAction::class)->setName('services.entrees');

    $app->get('/services/create', GetCreateServiceAction::class)->setName('services.create');

    $app->post('/services/create', PostCreateServiceAction::class)->setName('services.create.post');

    $app->get('/signin', GetConnectionAction::class)->setName('signin');

    $app->post('/signin', PostConnectionAction::class)->setName('signin.post');



    return $app;

};
