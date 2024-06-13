<?php

namespace webDirectory\admin\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use webDirectory\admin\app\utils\CsrfService;

class GetCreateEntreeAction extends Action
{
    private string $template;

    public function __construct()
    {
        $this->template = 'entreesCreate.html.twig';
    }

    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $view  = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, [
            'csrf'=> CsrfService::generate()
        ]);
    }
}