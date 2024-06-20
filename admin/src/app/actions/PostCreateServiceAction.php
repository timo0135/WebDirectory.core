<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\app\utils\CsrfServiceException;
use webDirectory\admin\core\services\departement\DepartementService;
use webDirectory\admin\core\services\departement\DepartementServiceBadDataException;
use webDirectory\admin\core\services\departement\DepartementServiceInterface;

class PostCreateServiceAction extends Action
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
            $this->departementService->createDepartement($data);
            return $rs->withHeader('Location', '/services/create')->withStatus(302);
        }catch (CsrfServiceException $e){
            throw new \Exception($e->getMessage());
        } catch (DepartementServiceBadDataException $e) {
            throw new HttpBadRequestException($rq, $e->getMessage());
        }

    }
}