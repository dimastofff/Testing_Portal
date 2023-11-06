<?php

namespace App\Utils;

use App\Models\Role;

class Router
{
    private static $list = [];

    public static function page(
        string $uri,
        string $pageName,
        Role $accessLevelRole = Role::Unauthorized,
    ): void {
        self::$list[] = [
            'uri' => $uri,
            'page' => $pageName,
            'isControllerHandled' => false,
            'accessLevelRole' => $accessLevelRole,
        ];
    }

    public static function controllerHandledRequest(
        string $uri,
        string $controllerClassName,
        string $controllerMethodName,
        array $data = null,
        Role $accessLevelRole = Role::Unauthorized,
    ): void {
        self::$list[] = [
            'uri' => $uri,
            'isControllerHandled' => true,
            'controllerClassName' => $controllerClassName,
            'controllerMethodName' => $controllerMethodName,
            'data' => $data,
            'accessLevelRole' => $accessLevelRole,
        ];
    }

    public static function enable(): void
    {
        $query = $_GET['q'];

        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                self::resolvePermissions($route['accessLevelRole']);
                if ($route['isControllerHandled']) {
                    $controllerInstance = new $route['controllerClassName'];
                    $methodName = $route['controllerMethodName'];
                    $data = $route['data'];
                    $controllerInstance->$methodName($data);
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

    private static function resolvePermissions(Role $accessLevelRole): void
    {
        $currentRole = isset($_SESSION['user']) ? Role::fromName($_SESSION['user']['role']) : Role::Unauthorized;

        if ($currentRole->value < $accessLevelRole->value) {
            self::redirectWithAlert('danger', 'Access denied', $_SESSION['redirectUri']);
        } else if ($currentRole->value > $accessLevelRole->value && $accessLevelRole === Role::Unauthorized) {
            self::redirect($_SESSION['redirectUri']);
        }
        return;
    }
}
