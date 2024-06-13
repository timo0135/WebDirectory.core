<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use webDirectory\admin\core\services\departement\DepartementService;
use webDirectory\admin\core\services\departement\DepartementServiceInterface;

class GetEntreesAction extends Action
{
    private string $template;
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->template = 'entrees.html.twig';
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $entrees = $this->departementService->getEntrees();
        usort($entrees, function($a, $b) {
            return $a['nom'] <=> $b['nom'];
        });
        foreach ($entrees as $key => $value){
            $entrees[$key]['departements'] = $this->departementService->getDepartementByEntree($value['id']);
        }
        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, ['entrees' => $entrees]);
    }
}