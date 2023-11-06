<?php

namespace App\Controllers;

use App\Utils\Router;
use App\Services\TestService;

class TestsController
{
    public function createTest(array $data): void
    {
        $name = $data['name'];

        if (strlen($name) < 4 || strlen($name) > 255) {
            $GLOBALS['LOGGER']->error('Incorrect registration form data for test creating: "' . $name . '"');
            Router::redirectWithAlert('danger', 'Form data incorrect.', '/tests/create_test');
        }

        try {
            if (TestService::createTest($_SESSION['user']['id'], $name)) {
                $GLOBALS['LOGGER']->info('Successfull test creation: "' . $name . '"');
                Router::redirectWithAlert('success', 'Successfull test creation.', '/tests');
            }
        } catch (\Exception $e) {
            $GLOBALS['LOGGER']->error($e->getMessage());
            Router::redirectWithAlert('danger', 'Creation test unsuccessfull', '/tests/create_test');
        }
    }
}
