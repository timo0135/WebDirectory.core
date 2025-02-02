<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use webDirectory\admin\app\providers\auth\AuthProviderInterface;
use webDirectory\admin\app\providers\auth\SessionAuthProvider;

class GetDeconnexion extends Action
{
    private AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        if ($this->authProvider->isSignedIn()) {
            $this->authProvider->signout();
            return $rs->withHeader('Location', '/')->withStatus(302);
        }
        return $rs->withHeader('Location', '/signin')->withStatus(302);

    }
}