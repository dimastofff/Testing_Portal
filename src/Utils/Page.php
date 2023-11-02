<?php

namespace App\Utils;

class Page
{
    public static function part(string $partName): void
    {
        require_once 'views/components/' . $partName . '.php';
    }

    public static function renderAlert(): void
    {
        if (isset($_COOKIE['alert-type']) && isset($_COOKIE['alert-message'])) {
            $alertType = $_COOKIE['alert-type'];
            $alertMessage = $_COOKIE['alert-message'];
            echo '<div class="container w-25 mt-4 alert alert-'.$alertType.' role="alert">
                    '.$alertMessage.'
                  </div>';
        }
    }
}
