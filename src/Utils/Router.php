<?php

namespace App\Utils;

class Router
{
    private static $list = [];

    public static function page(string $uri, string $pageName): void
    {
        self::$list[] = [
            'uri' => $uri,
            'page' => $pageName,
            'post' => false,
        ];
    }

    public static function post(string $uri, string $class, string $method): void
    {
        self::$list[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
            'post' => true,
        ];
    }

    public static function error(string $errorMessage): void
    {
        require_once 'views/errors/error.php';
    }

    public static function enable(): void
    {
        $query = $_GET['q'];

        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                if ($route['post'] === true && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $class = new $route['class'];
                    $method = $route['method'];
                    $class->$method($_POST);
                    die();
                } else {
                    require_once 'views/pages/' . $route['page'] . '.php';
                    die();
                }
            }
        }
        self::error('Page not found');
    }

    public static function redirect(string $uri): void
    {
        header('Location: ' . $uri);
        die();
    }

    public static function redirectWithAlert(string $alertType, string $alertMessage, string $uri): void
    {
        setcookie('alert-type', $alertType, time() + 1, '/');
        setcookie('alert-message', $alertMessage, time() + 1, '/');
        self::redirect($uri);
    }
}
