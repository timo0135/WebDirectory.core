<?php

namespace webDirectory\admin\core\services\auth;


interface AuthServiceInterface
{

    public function register(string $user_id, string $password): string;
    public function byCredentials(string $user_id, string $password): bool;
    public function getUserByEmail(string $email): array;



}