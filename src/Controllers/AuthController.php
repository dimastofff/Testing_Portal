<?php

namespace App\Controllers;

use App\Utils\Router;
use App\Services\UserService;

class AuthController
{
    public function registration(array $data): void
    {
        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['confirmPassword'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password !== $confirmPassword || strlen($password) < 6) {
            $GLOBALS['LOGGER']->error('Incorrect registration form data for user: "' . $email . '"');
            Router::redirectWithAlert('danger', 'Form data incorrect.', '/registration');
        }

        try {
            if (UserService::registration($email, $password)) {
                $GLOBALS['LOGGER']->info('Successfull registration for user: "' . $email . '"');
                Router::redirectWithAlert('success', 'User successfull registered.', '/login');
            }
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Registration unsuccessfull.', '/registration');
        }
    }

    public function login(array $data): void
    {
        $email = $data['email'];
        $password = $data['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8 || strlen($password) > 20) {
            $GLOBALS['LOGGER']->error('Incorrect login form data for user: "' . $email . '"');
            Router::redirectWithAlert('danger', 'Form data incorrect', '/login');
        }

        try {
            UserService::login($email, $password);
            $GLOBALS['LOGGER']->info('Successfull login for user: "' . $email . '"');
            Router::redirect('/profile');
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Login unsuccessfull', '/login');
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        Router::redirect('/login');
    }

    public function emailConfirmation($data): void
    {
        try {
            $emailConfirmationHash = $data['hash'];
            if (UserService::emailConfirmation($emailConfirmationHash)) {
                Router::redirectWithAlert('success', 'Email successfull confirmed', '/login');
            }
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Unsuccessfull email confirmation attempt', '/login');
        }
    }
}
