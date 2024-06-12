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
        
        // Format the response data
        $formattedEntrees = [
            'type' => 'collection',
            'count' => count($entreesData),
            'prestations' => []
        ];


        foreach ($entreesData as $entrees) {
            $departements = $this->departementService->getDepartementByEntree($entrees['id']);
            $depNoms = [];
            $depslink = [];
            foreach($departements as $dep) {
                $depNoms[] = $dep['nom'];
                $depslink[] = '/api/services/'.$dep['id'];
            }
            $formattedEntrees['entrees'][] = [
                'entree' => [
                    'nom' => $entrees['nom'],
                    'prenom' => $entrees['prenom'],
                    'departement' => $depNoms,
                ],
                'links' => [
                    'self' => [
                        'href' => '/api/entrees/'. $entrees['id']
                    ],
                    'categories' => $depslink
                ]
            ];
        }

        $responseJson = json_encode($formattedEntrees);
        $rs->getBody()->write($responseJson);
        

        return $rs->withHeader('Content-Type', 'application/json');
    }


}