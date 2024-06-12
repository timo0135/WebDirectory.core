<?php 

namespace webDirectory\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;

class GetEntreesBySearchAction extends Action {

    private DepartementServiceInterface $departementService;

    public function __construct() {
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response {
        $critereDeRecherche = $rq->getQueryParams()['q'];
        $entrees = $this->departementService->getEntreesBySearch($critereDeRecherche);

        // Formatage de la réponse
        $entreesFormatted = [];
        foreach ($entrees as $entree) {
            $entreesFormatted[] = [
                'entree' => [
                    'id' => $entree['id'],
                    'nom' => $entree['nom'],
                    'prenom' => $entree['prenom'],
                    'fonction' => $entree['fonction'],
                    'numeroBureau' => $entree['numeroBureau'],
                    'numeroTel1' => $entree['numeroTel1'],
                    'numeroTel2' => $entree['numeroTel2'],
                    'email' => $entree['email'],
                    'image' => $entree['image'],
                ],
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
    }

}