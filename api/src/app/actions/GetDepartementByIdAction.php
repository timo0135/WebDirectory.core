<?php 

namespace webDirectory\api\app\actions;

use webDirectory\api\app\utils\HeaderJson;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use webDirectory\api\core\services\departement\DepartementServiceNotFoundException;

class GetDepartementByIdAction extends Action {

    private DepartementServiceInterface $departementService;

    public function __construct() {
        $this->departementService = new DepartementService();
    }

	public function __invoke(Request $rq, Response $rs, $args): Response {
       
        try {
            $departementId = (int) $args['id'];
            $departement = $this->departementService->getDepartementById($departementId);

            // Formatage de la réponse
            $departementFormatted = [];
            $departementFormatted[] = [
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
            

            $responseContent = [
                'type' => 'resource',
                'departement' => $departementFormatted,
            ];

            return HeaderJson::setHeaderJson($rs, $responseContent);

        } catch (DepartementServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
	}
}