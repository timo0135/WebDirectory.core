<?php

namespace webDirectory\admin\app\utils;

class CsrfService
{
    public static function generate(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check(string $token): void
    {
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $token) {
            throw new CsrfServiceException('Token invalide');
        }
        unset($_SESSION['csrf_token']);
    }

}