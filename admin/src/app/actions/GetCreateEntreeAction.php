<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use webDirectory\admin\app\providers\auth\AuthProviderInterface;
use webDirectory\admin\app\providers\auth\SessionAuthProvider;
use webDirectory\admin\app\utils\CsrfService;

class GetCreateEntreeAction extends Action
{
    private string $template;
    private AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->template = 'entreesCreate.html.twig';
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        if ($this->authProvider->isSignedIn()){
            $view  = Twig::fromRequest($rq);
            return $view->render($rs, $this->template, [
                'csrf'=> CsrfService::generate()
            ]);
        }
        return $rs->withHeader('Location', '/signin')->withStatus(302);
    }
}