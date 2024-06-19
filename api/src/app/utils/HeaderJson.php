<?php

namespace webDirectory\api\app\utils;

class HeaderJson
{

    public static function setHeaderJson($rs, $responseContent)
    {
        // gestion de CORS
        $rs = $rs->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->withHeader('Content-Type', 'application/json');
        $rs->getBody()->write(json_encode($responseContent));
        return $rs;
    }

}