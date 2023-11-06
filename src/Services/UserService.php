<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\EntityRepository;

class UserService
{
    public static function registration(string $email, string $nickname, string $password): bool
    {
        $user = new User();
        $user->setEmail($email);
        $user->setNickname($nickname);
        $user->setPassword($password);
        $user->setEmailConfirmationHash(bin2hex(random_bytes(100)));
        $isUserSaved = EntityRepository::save($user);
        if ($isUserSaved) {
            EmailService::sendConfirmationLetter($user);
        }
        return $isUserSaved;
    }

    public static function login(string $email, string $password): User
    {
        $user = EntityRepository::getBy(User::class, ['email' => $email])[0] ?? null;
        if (!$user || !$user->checkPassword($password)) {
            throw new \Exception('Unsuccessfull login attempt for email: "' . $email . '"');
        }
        $user->setLastLoginAt(date('Y-m-d H:i:s', time()));
        EntityRepository::update($user, ['WHERE' => ['email' => $email]]);
        return $user;
    }

    public static function emailConfirmation(string $emailConfirmationHash): bool
    {
        $user = EntityRepository::getBy(User::class, ['emailConfirmationHash' => $emailConfirmationHash])[0] ?? null;
        if (!$user) {
            throw new \Exception('Unsuccessfull email confirmation attempt for hash: "' . $emailConfirmationHash . '"');
        }
        $user->setIsEmailConfirmed(true);
        $user->setEmailConfirmationHash(null);
        $user->setEmailConfirmedAt(date('Y-m-d H:i:s', time()));
        return EntityRepository::update($user, ['WHERE' => ['email' => $user->getEmail(), 'id' => $user->getId()]]);
    }
}
