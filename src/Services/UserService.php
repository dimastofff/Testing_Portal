<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Repositories\EntityRepository;

class UserService
{
    public static function registration(string $email, string $password): bool
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRole(Role::User->name);
        return EntityRepository::save($user);
    }

    public static function login(string $email, string $password): User
    {
        $user = EntityRepository::getBy(User::class, ['email'=> $email])[0] ?? null;
        if (!$user || !$user->checkPassword($password)) {
            throw new \Exception('Unsuccessfull login attempt for email: "' . $email . '"');
        }
        return $user;
    }
}