<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;


$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$twig = Twig::create(__DIR__ . '/../app/views', ['cache' => false]);
$twig->getEnvironment()->addGlobal('css', 'assets/css');
$twig->getEnvironment()->addGlobal('img', 'assets/img');
$twig->getEnvironment()->addGlobal('js', 'assets/js');

/*$sessionMiddleware = function (Request $request, RequestHandler $handler) use ($twig): Response {

    return $handler->handle($request);
};*/


$app->add(TwigMiddleware::create($app, $twig));
/*$app->add($sessionMiddleware);*/



$app = (require_once __DIR__ . '/routes.php')($app);

return $app;

