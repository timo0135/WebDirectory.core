<?php 

namespace webDirectory\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use webDirectory\api\core\services\departement\DepartementServiceNotFoundException;

class GetEntreesBySearchAction extends Action {

    private DepartementServiceInterface $departementService;

    public function __construct() {
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response {
        try{
            $critereDeRecherche = $rq->getQueryParams()['q']?? null;
            if ($critereDeRecherche == null) {
                throw new HttpBadRequestException($rq, 'Le critère de recherche est obligatoire');
            }
            $trie = $rq->getQueryParams()['sort'] ?? null;
            if ($trie != null) {
                $trie = explode('-', $trie);
                $colum = $trie[0];
                $order = $trie[1];
                $entrees = $this->departementService->getEntreesBySearchOrder($critereDeRecherche, $order, $colum);
            } else {
                $entrees = $this->departementService->getEntreesBySearch($critereDeRecherche);
            }


            // Formatage de la réponse
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

            $responseContent = [
                'type' => 'collection',
                'count' => count($entreesFormatted),
                'entrees' => $entreesFormatted,
            ];

            $rs->getBody()->write(json_encode($responseContent));

            return $rs->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }catch (DepartementServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
    }

}