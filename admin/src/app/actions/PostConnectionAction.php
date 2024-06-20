<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use webDirectory\admin\app\providers\auth\AuthProviderInterface;
use webDirectory\admin\app\providers\auth\SessionAuthProvider;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\app\utils\CsrfServiceException;

class PostConnectionAction extends Action
{
    private AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        try{
            $data = $rq->getParsedBody();

            CsrfService::check($data['csrf']);
            $this->authProvider->signin($data['email'], $data['password']);
            if ($this->authProvider->isSignedIn()){
                return $rs->withHeader('Location', '/entrees')->withStatus(302);
            }
            return $rs->withHeader('Location', '/signin')->withStatus(302);
        }catch (CsrfServiceException $e){
            throw new \Exception($e->getMessage());
        }
    }
}