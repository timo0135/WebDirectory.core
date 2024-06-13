<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpForbiddenException;
use webDirectory\admin\app\providers\auth\AuthProviderInterface;
use webDirectory\admin\app\providers\auth\SessionAuthProvider;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\core\services\auth\AuthServiceBadException;
use webDirectory\admin\core\services\authorization\AuthorizationService;
use webDirectory\admin\core\services\authorization\AuthorizationServiceInterface;

class PostInscriptionAction extends Action
{
    private AuthorizationServiceInterface $authorizationService;
    private AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->authorizationService = new AuthorizationService();
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try{
            $data = $rq->getParsedBody();
            CsrfService::check($data['csrf']);
            if($this->authProvider->isSignedIn()) {
                if ($this->authorizationService->isGranted($_SESSION['user']['id'], addAcount, '')) {
                    if ($data['password'] === $data['password_confirm']){
                        $this->authProvider->register($data['email'], $data['password']);
                        return $rs->withHeader('Location', '/entrees')->withStatus(302);
                    }
                    return $rs->withHeader('Location', '/signup')->withStatus(302);
                }
                throw new HttpForbiddenException($rq, 'Vous n\'avez pas les droits pour consulter cette page');
            }
            return $rs->withHeader('Location', '/signin')->withStatus(302);
        }catch (AuthServiceBadException $e){
            return $rs->withHeader('Location', '/signup')->withStatus(302);
        }catch (\Exception $e){
            throw new \Exception('Données invalides');
        }
    }
}