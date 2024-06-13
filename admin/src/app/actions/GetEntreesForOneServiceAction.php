<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use webDirectory\admin\core\services\departement\DepartementService;
use webDirectory\admin\core\services\departement\DepartementServiceInterface;

class GetEntreesForOneServiceAction extends Action
{
    private string $template;
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->template = 'servicesEntrees.html.twig';
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $entrees = $this->departementService->getEntreesByDepartement($args['id']);
        usort($entrees, function($a, $b) {
            return $a['nom'] <=> $b['nom'];
        });
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['entrees' => $entrees]);
    }
}