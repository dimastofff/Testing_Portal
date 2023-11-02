<?php

use App\Utils\Router;
use App\Controllers\AuthController;

Router::page('/', 'login');
Router::page('/login', 'login');
Router::page('/registration','registration');
Router::page('/profile', 'profile');
Router::page('/admin/users', 'admin/users');

Router::controllerHandledRequest('/auth/registration', AuthController::class, 'registration', $_POST);
Router::controllerHandledRequest('/auth/login', AuthController::class, 'login', $_POST);
Router::controllerHandledRequest('/auth/logout', AuthController::class, 'logout');
Router::controllerHandledRequest('/auth/emailConfirmation', AuthController::class, 'emailConfirmation', $_REQUEST);

Router::enable();
