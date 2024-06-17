<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use webDirectory\admin\core\services\departement\DepartementService;
use webDirectory\admin\core\services\departement\DepartementServiceInterface;

class GetDepartementsAction extends Action
{
    private string $template;
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->template = 'departements.html.twig';
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $departements = $this->departementService->getDepartements();
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['departements' => $departements]);
    }
}