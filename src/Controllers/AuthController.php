<?php

namespace App\Controllers;

use App\Utils\Router;
use App\Services\UserService;

class AuthController
{
    public function registration($post_data)
    {
        $email = $post_data['email'];
        $password = $post_data['password'];
        $confirmPassword = $post_data['confirmPassword'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password !== $confirmPassword || strlen($password) < 6) {
            $GLOBALS['LOGGER']->error('Incorrect registration form data for user: "' . $email . '"');
            Router::redirectWithAlert('danger', 'Form data incorrect', '/registration');
        }

        try {
            if (UserService::registration($email, $password)) {
                $GLOBALS['LOGGER']->info('Successfull registration for user: "' . $email . '"');
                Router::redirectWithAlert('success', 'User successfull registered', '/login');
            }
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Registration unsuccessfull', '/registration');
        }
    }

    public function login($post_data)
    {
        $email = $post_data['email'];
        $password = $post_data['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
            $GLOBALS['LOGGER']->error('Incorrect login form data for user: "' . $email . '"');
            Router::redirectWithAlert('danger', 'Form data incorrect', '/login');
        }

        try {
            $user = UserService::login($email, $password);
            $_SESSION['user'] = [
                'email' => $user->getEmail(),
            ];
            $GLOBALS['LOGGER']->info('Successfull login for user: "' . $email . '"');
            Router::redirectWithAlert('success', 'User successfull logged in', '/profile');
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Login unsuccessfull', '/login');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        Router::redirect('/login');
    }
}
