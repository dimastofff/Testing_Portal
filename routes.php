<?php

use App\Utils\Router;
use App\Controllers\AuthController;
use App\Controllers\TestsController;

Router::page('/', 'auth/login');
Router::page('/login', 'auth/login');
Router::page('/registration', 'auth/registration');
Router::page('/profile', 'profile');
Router::page('/admin/users', 'admin/users');
Router::page('/tests', 'tests/tests_list');
Router::page('/tests/create_test', 'tests/create_test');

Router::controllerHandledRequest('/auth/registration', AuthController::class, 'registration', $_POST);
Router::controllerHandledRequest('/auth/login', AuthController::class, 'login', $_POST);
Router::controllerHandledRequest('/auth/logout', AuthController::class, 'logout');
Router::controllerHandledRequest('/auth/emailConfirmation', AuthController::class, 'emailConfirmation', $_REQUEST);
Router::controllerHandledRequest('/tests/create', TestsController::class, 'createTest', $_POST);

Router::enable();
