<?php

namespace webDirectory\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use webDirectory\api\core\services\departement\DepartementServiceNotFoundException;

class GetEntreesByOneServiceAction extends Action
{
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->departementService = new DepartementService();
    }
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try {
            $departement_id = $args['id'];
            $entrees = $this->departementService->getEntreesByDepartement($departement_id);


            $entreesFormatted = [];
            foreach ($entrees as $entree) {
                $departements = $this->departementService->getDepartementByEntree($entree['id']);
                $departementsFormatted = [];
                foreach ($departements as $departement) {
                    $departementsFormatted[] = [
                        'departement' => [
                            'id' => $departement['id'],
                            'nom' => $departement['nom'],
                            'etage' => $departement['etage'],
                            'description' => $departement['description']
                        ],
                        'links' => [
                            'self' => ['href' => '/services/' . $departement['id'] . '/']
                        ]
                    ];
                }
                $entreesFormatted[] = [
                    'entree' => [
                        'nom' => $entree['nom'],
                        'prenom' => $entree['prenom'],
                        'departement' => $departementsFormatted

                    ],
                    'links' => [
                        'self' => ['href' => '/entrees/' . $entree['id'] . '/']
                    ]
                ];
            }
            $json = [
                'type' => 'collection',
                'count' => count($entreesFormatted),
                'entrées' => $entreesFormatted

            ];
            $rs->getBody()->write(json_encode($json));
            return $rs->withHeader('Content-Type', 'application/json');
        }catch (DepartementServiceNotFoundException $e){
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
    }
}