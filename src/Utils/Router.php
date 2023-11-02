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
            'isControllerHandled' => false,
        ];
    }

    public static function controllerHandledRequest(string $uri, string $controllerClassName, string $controllerMethodName, array $data = null)
    {
        self::$list[] = [
            'uri' => $uri,
            'isControllerHandled' => true,
            'controllerClassName' => $controllerClassName,
            'controllerMethodName' => $controllerMethodName,
            'data' => $data,
        ];
    }

    public static function enable(): void
    {
        $query = $_GET['q'];

        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                if ($route['isControllerHandled'] === true) {
                    $controllerInstance = new $route['controllerClassName'];
                    $methodName = $route['controllerMethodName'];
                    $data = $route['data'];
                    $controllerInstance->$methodName($data);
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

    public static function error(string $errorMessage): void
    {
        require_once 'views/errors/error.php';
    }
}
