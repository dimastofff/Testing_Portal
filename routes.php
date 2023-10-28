<?php

use App\Utils\Router;
use App\Controllers\AuthController;

Router::page('/', 'login');
Router::page('/login', 'login');
Router::page('/registration','registration');
Router::page('/profile', 'profile');

Router::post('/auth/registration', AuthController::class, 'registration');
Router::post('/auth/login', AuthController::class, 'login');
Router::post('/auth/logout', AuthController::class, 'logout');

Router::enable();
