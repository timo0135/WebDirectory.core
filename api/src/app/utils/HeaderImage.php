<?php

namespace webDirectory\api\app\utils;

class HeaderImage
{

    public static function setHeaderImage($rs, $imagePath)
    {
        // Obtenir le type MIME de l'image
        $mimeType = mime_content_type($imagePath);
        // Configurer les en-têtes CORS et le type de contenu
        $rs = $rs->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withHeader('Content-Type', $mimeType);

        $imageContent = file_get_contents($imagePath);
        $rs->getBody()->write($imageContent);
        return $rs;

    }

}