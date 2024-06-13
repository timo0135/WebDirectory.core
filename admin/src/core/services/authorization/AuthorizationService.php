<?php

namespace webDirectory\admin\core\services\authorization;


use webDirectory\admin\core\domain\entities\User;

class AuthorizationService implements AuthorizationServiceInterface
{

    public function isGranted(string $user_id, int $operation, string $ressource_id): bool
    {
        if ($operation === addAcount) {
            return $this->isSuperAdmin($user_id);
        }
        return false;

    }

    private function isSuperAdmin(string $user_id): bool
    {
        $user = User::where('id', $user_id)->first();
        if ($user->role === 100) {
            return true;
        }
        return false;
    }

}