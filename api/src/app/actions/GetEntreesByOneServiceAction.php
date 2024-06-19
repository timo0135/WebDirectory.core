<?php

namespace webDirectory\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use webDirectory\api\app\utils\HeaderJson;
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
            $trie = $rq->getQueryParams()['sort'] ?? null;
            if ($trie != null) {
                $trie = explode('-', $trie);
                $colum = $trie[0];
                $order = $trie[1];
                $entrees = $this->departementService->getEntreesByDepartementOrder($departement_id, $order, $colum);
            } else {
                $entrees = $this->departementService->getEntreesByDepartement($departement_id);
            }



            $entreesFormatted = [];
            foreach ($entrees as $entree) {
                $departements = $this->departementService->getDepartementByEntree($entree['id']);
                $depNoms = [];
                $depslink = [];
                foreach($departements as $dep) {
                    $depNoms[] = $dep['nom'];
                    $depslink[] = '/api/services/'.$dep['id'].'/entrees';
                }
                $entreesFormatted[] = [
                    'entree' => [
                        'nom' => $entree['nom'],
                        'prenom' => $entree['prenom'],
                        'departement' => $depNoms,
                    ],
                    'links' => [
                        'self' => [
                            'href' => '/api/entrees/'. $entree['id']
                        ],
                        'categories' => $depslink
                    ]
                ];
            }
            $json = [
                'type' => 'collection',
                'count' => count($entreesFormatted),
                'entrees' => $entreesFormatted

            ];
            return HeaderJson::setHeaderJson($rs, $json);
        }catch (DepartementServiceNotFoundException $e){
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
    }
}