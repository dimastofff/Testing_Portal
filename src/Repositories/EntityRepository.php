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
        $statement = self::createStatementFromHash($sql, $variables);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $entityClassName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save(Entity $entity): bool
    {
        $sql = SqlGenerator::generateInsertSql($entity);
        $statement = self::createStatementFromEntity($sql, $entity);
        return $statement->execute();
    }

    public static function update(Entity $entity): Entity
    {
        return new Entity();
    }

    public static function deleteBy(string $entityClassName, array $variables): bool
    {
        return true;
    }

    private static function createStatementFromEntity(string $sql, Entity $entity) : \PDOStatement
    {
        $statement = $GLOBALS['PDO_CONNECTION']->prepare($sql);
        $reflection = new \ReflectionClass($entity::class);
        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();
            $statement->bindValue(":".$propertyName, SqlGenerator::getEntityPropertyValue($entity, $property->getName()));
        }
        return $statement;
    }

    private static function createStatementFromHash(string $sql, array $variables) : \PDOStatement
    {
        $statement = $GLOBALS['PDO_CONNECTION']->prepare($sql);
        foreach ($variables as $column => $value) {
            $statement->bindValue(":" . $column, $value);
        }
        return $statement;
    }
}
