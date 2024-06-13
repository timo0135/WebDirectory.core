<?php

namespace webDirectory\admin\app\providers\auth;

interface AuthProviderInterface
{
    public function register(string $email, string $password): void;
    public function signin(string $email, string $password): void;
    public function signout(): void;
    public function isSignedIn(): bool;

    public function getSignedInUser(): array;


}