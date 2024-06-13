<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\core\services\departement\DepartementService;
use webDirectory\admin\core\services\departement\DepartementServiceInterface;
use webDirectory\admin\core\services\departement\DepartementServiceNotFoundException;

class PostEntreeStatutAction extends Action
{
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try{
            $data = $rq->getParsedBody();
            CsrfService::check($data['csrf']);
            $this->departementService->changeEntreeStatut($data['id']);
            return $rs->withHeader('Location', '/entrees')->withStatus(302);
        }catch (DepartementServiceNotFoundException $e){
            throw new HttpNotFoundException($rq, 'Entree non trouvée');
        }catch (\Exception $e) {
            throw new \Exception('Données invalides');
        }
    }
}