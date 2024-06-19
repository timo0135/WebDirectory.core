<?php

namespace webDirectory\api\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use webDirectory\api\app\utils\HeaderImage;

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
        return HeaderImage::setHeaderImage($rs, $imagePath);
    }
}
