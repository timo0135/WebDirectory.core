<?php

namespace webDirectory\admin\core\services\auth;

use webDirectory\admin\core\domain\entities\User;

class AuthService implements AuthServiceInterface
{

    public function register(string $user_id, string $password): string
    {
        $verifie = User::where('user_id', $user_id)->first();
        if ($verifie !== null) {
            throw new AuthServiceBadException("Utilisateur déjà existant");
        }
        $user = new User();
        $user->user_id = $user_id;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->role = 1;
        $user->save();
        return $user->id;
    }

    public function byCredentials(string $user_id, string $password): bool
    {
        $user = User::where('user_id', $user_id)->first();
        if ($user === null) {
            return false;
        }
        return password_verify($password, $user->password);
    }

    public function getUserByEmail(string $email): array
    {
        try {
            $user = User::where('user_id', $email)->first();
        } catch (\Exception $e) {
            return [];
        }
        return $user->toArray();
    }
}