<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpForbiddenException;
use webDirectory\admin\app\providers\auth\AuthProviderInterface;
use webDirectory\admin\app\providers\auth\SessionAuthProvider;
use webDirectory\admin\app\utils\CsrfService;
use webDirectory\admin\app\utils\CsrfServiceException;
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
        try {
            $data = $rq->getParsedBody();
            CsrfService::check($data['csrf']);

            $password = $data['password'];
            $password_confirm = $data['password_confirm'];
            $passwordLength = strlen($password);
            $containsLetter  = preg_match('/[a-zA-Z]/', $password);
            $containsDigit   = preg_match('/\d/', $password);
            $containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);

            if ($passwordLength < 8 || !$containsLetter || !$containsDigit || !$containsSpecial) {
                $_SESSION['error_message'] = 'Le mot de passe doit contenir au moins 8 caractères, incluant des lettres, des chiffres et des caractères spéciaux.';
                return $rs->withHeader('Location', '/signup')->withStatus(302);
            }

            if ($password !== $password_confirm) {
                $_SESSION['error_message'] = 'Les mots de passe ne correspondent pas.';
                return $rs->withHeader('Location', '/signup')->withStatus(302);
            }

            if ($this->authProvider->isSignedIn()) {
                if ($this->authorizationService->isGranted($_SESSION['user']['id'], 'addAccount', '')) {
                    unset($_SESSION['error_message']);
                    $this->authProvider->register($data['email'], $password);
                    return $rs->withHeader('Location', '/entrees')->withStatus(302);
                }
                throw new HttpForbiddenException($rq, 'Vous n\'avez pas les droits pour consulter cette page');
            }

            return $rs->withHeader('Location', '/signin')->withStatus(302);
        } catch (AuthServiceBadException $e) {
            return $rs->withHeader('Location', '/signup')->withStatus(302);
        } catch (CsrfServiceException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
