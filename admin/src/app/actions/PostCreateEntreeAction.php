<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\core\services\departement\DepartementService;
use webDirectory\admin\core\services\departement\DepartementServiceInterface;

class PostCreateEntreeAction extends Action
{
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $data = $rq->getParsedBody();
            CsrfService::check($data['csrf']);
            $departement = array_filter($data, function ($key) {
                return strpos($key, 'department') === 0;
            }, ARRAY_FILTER_USE_KEY);
            $entree = array_filter($data, function ($key) {
                return strpos($key, 'department') !== 0;
            }, ARRAY_FILTER_USE_KEY);
            $id = $this->departementService->createEntree($entree, $departement['departments']);
            return $rs->withHeader('Location', '/entrees/create')->withStatus(302);
        }catch (\Exception $e) {
            throw new \Exception('Données invalides');
        }
    }
}