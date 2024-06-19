<?php

use Slim\Factory\AppFactory;


$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$app = (require_once __DIR__ . '/routes.php')($app);

return $app;

