<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpForbiddenException;
use Slim\Views\Twig;
use webDirectory\admin\app\providers\auth\AuthProviderInterface;
use webDirectory\admin\app\providers\auth\SessionAuthProvider;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\core\services\authorization\AuthorizationService;
use webDirectory\admin\core\services\authorization\AuthorizationServiceInterface;

class GetInscriptionAction extends Action
{
    private string $template ;
    private AuthorizationServiceInterface $authorizationService;
    private AuthProviderInterface $authProvider;

    public function __construct()
    {
        $this->template = 'inscription.html.twig';
        $this->authorizationService = new AuthorizationService();
        $this->authProvider = new SessionAuthProvider();
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        if($this->authProvider->isSignedIn()){
            if ($this->authorizationService->isGranted($_SESSION['user']['id'], addAcount, '')){
                $view = Twig::fromRequest($rq);
                return $view->render($rs, $this->template, ['csrf' => CsrfService::generate()]);
            }
            throw new HttpForbiddenException($rq, 'Vous n\'avez pas les droits pour consulter cette page');
        }
        return $rs->withHeader('Location', '/signin')->withStatus(302);
    }
}