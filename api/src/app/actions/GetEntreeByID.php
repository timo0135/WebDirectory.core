<?php
namespace webDirectory\api\app\actions;

use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class GetEntreeByID extends Action
{
    private DepartementServiceInterface $departementService;
 public function __construct()
 {
        $this->departementService = new DepartementService();
 }

        public function __invoke($rq, $rs, $args): Response
        {
            $entreeId = $args['id'];
            $entree = $this->departementService->getEntreeById($entreeId);
            $departements = $this->departementService->getDepartementByEntree($entreeId);
            $depNoms = [];
            $depslink = [];
            foreach($departements as $dep) {
                $depNoms[] = $dep['nom'];
                $depslink[] = '/api/services/'.$dep['id'];
            }
            $formattedEntree = [
                'type' => 'resource',
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
                    'statut' => $entree['statut'],
                    'departement' => $depNoms,


                ],
                'links' => [

                    'categories' => $depslink
                ]

            ];
            $rs->getBody()->write(json_encode($formattedEntree));
            return $rs->withHeader('Content-Type', 'application/json');
        }
}