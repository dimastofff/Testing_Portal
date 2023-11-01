<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Utils\SqlGenerator;

class EntityRepository
{
    public static function getBy(string $entityClassName, array $variables): array
    {
        $entity = new $entityClassName();
        $sql = SqlGenerator::generateSelectSql($entity, $variables);
        $statement = self::createStatement($sql);
        self::prepareStatementFromHash($statement, $variables);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $entityClassName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save(Entity $entity): bool
    {
        $sql = SqlGenerator::generateInsertSql($entity);
        $statement = self::createStatement($sql);
        self::prepareStatementFromEntity($statement, $entity);
        return $statement->execute();
    }

    public static function update(Entity $entity, array $variables): bool
    {
        $sql = SqlGenerator::generateUpdateSql($entity, $variables);
        $statement = self::createStatement($sql);
        self::prepareStatementFromEntity($statement, $entity);
        self::prepareStatementFromHash($statement, $variables);
        return $statement->execute();
    }

    public static function deleteBy(string $entityClassName, array $variables): bool
    {
        return true;
    }

    private static function createStatement(string $sql): \PDOStatement
    {
        return $GLOBALS['PDO_CONNECTION']->prepare($sql);
    }

    private static function prepareStatementFromEntity(\PDOStatement $statement, Entity $entity) : void
    {
        foreach ($entity->getModifiedProperties() as $propertyName) {
            $statement->bindValue(":".$propertyName, SqlGenerator::getEntityPropertyValue($entity, $propertyName));
        }
    }

    private static function prepareStatementFromHash(\PDOStatement $statement, array $variables) : void
    {
        if (isset($variables['where'])) {
            $isWhereConditionBinding = true;
            $variables = $variables['where'];
        } else {
            $isWhereConditionBinding = false;
        }
        foreach ($variables as $column => $value) {
            $column = $isWhereConditionBinding ? 'WHERE_' . $column : $column;
            $statement->bindValue(":" . $column, $value);
        }
    }
}
