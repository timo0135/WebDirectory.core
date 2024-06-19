<?php
namespace webDirectory\api\app\actions;

use Slim\Exception\HttpNotFoundException;
use webDirectory\api\app\utils\HeaderJson;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use webDirectory\api\core\services\departement\DepartementServiceNotFoundException;

class GetEntreeByID extends Action
{
    private DepartementServiceInterface $departementService;
 public function __construct()
 {
        $this->departementService = new DepartementService();
 }

        public function __invoke($rq, $rs, $args): Response
        {
            try{
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
                        'statut' => $entree['statut'],
                        'departement' => $depNoms,


                    ],
                    'links' => [
                        'image' => '/img/'.$entree['image'],
                        'categories' => $depslink
                    ]

                ];
                return HeaderJson::setHeaderJson($rs, $formattedEntree);
            }catch (DepartementServiceNotFoundException $e) {
                throw new HttpNotFoundException($rq, $e->getMessage());
            }
        }
}