<?php 

namespace webDirectory\api\app\actions;

use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetDepartementsAction extends Action {

    private DepartementServiceInterface $departementService;

    public function __construct() {
        $this->departementService = new DepartementService();
    }

	public function __invoke(Request $rq, Response $rs, $args): Response {
        $departements = $this->departementService->getDepartements();
        
        // Formatage de la réponse
        $departementsFormatted = [];
        foreach($departements as $departement) {
            $departementsFormatted[] = [
                'departement' => [
                    'id' => $departement['id'],
                    'nom' => $departement['nom'],
                    'etage' => $departement['etage'],
                    'description' => $departement['description'],
                ],
                'links' => [
                    'self' => '/api/services/' . $departement['id']
                ]
            ];
        }

        $responseContent = [
            'type' => 'collection',
            'count' => count($departementsFormatted),
            'departements' => $departementsFormatted,
        ];

        $rs->getBody()->write(json_encode($responseContent));

        return $rs->withHeader('Content-Type', 'application/json')
                  ->withStatus(200);
	}
}