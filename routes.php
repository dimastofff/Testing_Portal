<?php

use App\Models\Role;
use App\Utils\Router;
use App\Controllers\AuthController;
use App\Controllers\TestsController;

Router::page('/', 'auth/login', Role::Unauthorized, '/profile');
Router::page('/login', 'auth/login', Role::Unauthorized, '/profile');
Router::page('/registration', 'auth/registration', Role::Unauthorized, '/profile');
Router::page('/profile', 'profile', Role::User);
Router::page('/admin/users', 'admin/users', Role::Admin);
Router::page('/tests', 'tests/tests_list', Role::User);
Router::page('/tests/create_test', 'tests/create_test', Role::Moderator);

Router::controllerHandledRequest('/auth/registration', AuthController::class, 'registration', $_POST);
Router::controllerHandledRequest('/auth/login', AuthController::class, 'login', $_POST);
Router::controllerHandledRequest('/auth/logout', AuthController::class, 'logout', null, Role::User);
Router::controllerHandledRequest('/auth/emailConfirmation', AuthController::class, 'emailConfirmation', $_REQUEST);
Router::controllerHandledRequest('/tests/create', TestsController::class, 'createTest', $_POST, Role::Moderator);

Router::enable();
