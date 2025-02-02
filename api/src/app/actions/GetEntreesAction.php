<?php
namespace webDirectory\api\app\actions;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use webDirectory\api\app\utils\HeaderJson;
use webDirectory\api\core\services\departement\DepartementService;
use webDirectory\api\core\services\departement\DepartementServiceInterface;
use webDirectory\api\core\services\departement\DepartementServiceNotFoundException;

class GetEntreesAction extends Action {

    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->departementService = new DepartementService();
    }

    public  function __invoke( Request $rq, Response $rs, $args): Response {

        try{
            $trie = $rq->getQueryParams()['sort'] ?? null;
            if ($trie != null) {
                $trie = explode('-', $trie);
                $colum = $trie[0];
                $order = $trie[1];
                $entreesData = $this->departementService->getEntreesOrder($order, $colum);
            } else {
                $entreesData = $this->departementService->getEntrees();
            }



            // Format the response data
            $formattedEntrees = [
                'type' => 'collection',
                'count' => count($entreesData)
            ];


            foreach ($entreesData as $entrees) {
                $departements = $this->departementService->getDepartementByEntree($entrees['id']);
                $depNoms = [];
                $depslink = [];
                foreach($departements as $dep) {
                    $depNoms[] = $dep['nom'];
                    $depslink[] = '/api/services/'.$dep['id'].'/entrees';
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

            return HeaderJson::setHeaderJson($rs, $formattedEntrees);
        }catch (DepartementServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }
    }


}