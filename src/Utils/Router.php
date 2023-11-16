<?php

namespace App\Utils;

use App\Models\Role;

class Router
{
    private static $routes = [];

    public static function page(
        string $uri,
        string $pageName,
        Role $accessLevelRole = Role::Unauthorized,
        string $redirectUri = null,
    ): void {
        self::$routes[] = [
            'uri' => $uri,
            'page' => $pageName,
            'isControllerHandled' => false,
            'accessLevelRole' => $accessLevelRole,
            'redirectUri' => $redirectUri ?? '/',
        ];
    }

    public static function controllerHandledRequest(
        string $uri,
        string $controllerClassName,
        string $controllerMethodName,
        array $data = null,
        Role $accessLevelRole = Role::Unauthorized,
        string $redirectUri = null,
    ): void {
        self::$routes[] = [
            'uri' => $uri,
            'isControllerHandled' => true,
            'controllerClassName' => $controllerClassName,
            'controllerMethodName' => $controllerMethodName,
            'data' => $data,
            'accessLevelRole' => $accessLevelRole,
            'redirectUri' => $redirectUri ?? '/',
        ];
    }

    public static function enable(): void
    {
        $query = $_GET['q'];

        foreach (self::$routes as $route) {
            if ($route['uri'] === '/' . $query) {
                if (!PermissionsManager::isUserHasAccess($route['accessLevelRole'])) {
                    Router::redirect($route['redirectUri']);
                }
                if ($route['isControllerHandled']) {
                    $controllerInstance = new $route['controllerClassName'];
                    $methodName = $route['controllerMethodName'];
                    $controllerInstance->$methodName($route['data']);
                } else {
                    require_once 'views/pages/' . $route['page'] . '.php';
                }
                die();
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
