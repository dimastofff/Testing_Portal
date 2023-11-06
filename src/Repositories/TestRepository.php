<?php

namespace App\Repositories;

use App\Models\Test;

class TestRepository extends EntityRepository
{
    public static function getTestsForUsers(): array
    {
        $sql = <<<SQL
            SELECT
                tests.name AS name,
                users.nickname AS author,
                COUNT(questions.id) AS questionsCount
            FROM
                tests
            LEFT JOIN users ON tests.idAuthor = users.id
            LEFT JOIN questions ON questions.idTest = tests.id
            GROUP BY
                tests.id,
                users.nickname
        SQL;
        $statement = self::createStatement($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Test::class);
        $statement->execute();
        return $statement->fetchAll();
    }
}
