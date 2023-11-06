<?php

namespace App\Services;

use App\Models\Test;
use App\Repositories\EntityRepository;

class TestService
{
    public static function createTest(int $idAuthor, string $name): bool
    {
        $test = new Test();
        $test->setIdAuthor($idAuthor);
        $test->setName($name);
        return EntityRepository::save($test);
    }
}
