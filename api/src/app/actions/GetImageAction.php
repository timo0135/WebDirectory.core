<?php

namespace webDirectory\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class GetImageAction extends Action
{
    public function __invoke(Request $rq, Response $rs, $args): Response
    {
        $imageName = $args['image'];
        $imagePath = __DIR__ . '/../../../html/assets/img/' . $imageName;

        // Vérifier si l'image existe
        if (!file_exists($imagePath)) {
            throw new HttpNotFoundException($rq, "Image not found");
        }

        // Obtenir le type MIME de l'image
        $mimeType = mime_content_type($imagePath);
        // Configurer les en-têtes CORS et le type de contenu
        $rs = $rs->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withHeader('Content-Type', $mimeType);

        $imageContent = file_get_contents($imagePath);
        $rs->getBody()->write($imageContent);

        return $rs;
    }
}
