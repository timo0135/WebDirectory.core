<?php
namespace webDirectory\api\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;

class GetEntreesAction extends Action {

    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->departementService = new DepartementService();
    }

    public  function __invoke( Request $rq, Response $rs, $args): Response {

        $entreesData = $this->departementService->getEntrees();
        /*
        // Format the response data
        $formattedEntrees = [
            'type' => 'collection',
            'count' => count($entreesData),
            'prestations' => []
        ];

        foreach ($entreesData as $entrees) {
            $formattedEntrees['entrees'][] = [
                'prestation' => [
                    'nom' => $entrees['nom'],
                    'prenom' => $entrees['prenom'],
                    'departement' => $entrees['departements'],
                ],
                'links' => [
                    'self' => [
                        'href' => '/entrees?id=' . $entrees['id']
                    ],
                    'categorie' => [
                        'href' => '/categorie/' . $entrees['categorie']['id']
                    ]
                ]
            ];
        }

        $responseJson = json_encode($formattedPrestations);
        $rs->getBody()->write($responseJson);
        */

        return $rs->withHeader('Content-Type', 'application/json');
    }


}