<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Models\User;
use App\Utils\SqlGenerator;

class EntityRepository
{
    public static function getBy(string $entityClassName, array $variables = null): array
    {
        $entity = new $entityClassName();
        $sql = SqlGenerator::generateSelectSql($entity, $variables);
        $statement = self::createStatement($sql);
        if (isset($variables)) {
            self::prepareStatementFromHash($statement, $variables);
        }
        $statement->setFetchMode(\PDO::FETCH_CLASS, $entityClassName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save(Entity $entity): int
    {
        $currentTimestamp = date('Y-m-d H:i:s', time());
        $entity->setCreatedAt($currentTimestamp);
        $entity->setUpdatedAt($currentTimestamp);
        $sql = SqlGenerator::generateInsertSql($entity);
        $statement = self::createStatement($sql);
        self::prepareStatementFromEntity($statement, $entity);
        $statement->execute();
        $entity->resetModifiedProperties();
        return $GLOBALS['PDO_CONNECTION']->lastInsertId();
    }

    public static function update(Entity $entity, array $variables): bool
    {
        $entity->setUpdatedAt(date('Y-m-d H:i:s', time()));
        $sql = SqlGenerator::generateUpdateSql($entity, $variables);
        $statement = self::createStatement($sql);
        self::prepareStatementFromEntity($statement, $entity);
        self::prepareStatementFromHash($statement, $variables);
        $result = $statement->execute();
        if ($result && $entity instanceof User && isset($_SESSION['user'])) {
            $entity->updateSessionTrigger();
        }
        $entity->resetModifiedProperties();
        return $result;
    }

    public static function deleteBy(string $entityClassName, array $variables): bool
    {
        return true;
    }

    protected static function createStatement(string $sql): \PDOStatement
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
        if (isset($variables['WHERE'])) {
            $isWhereConditionBinding = true;
            $variables = $variables['WHERE'];
        } else {
            $isWhereConditionBinding = false;
        }
        foreach ($variables as $column => $value) {
            $column = $isWhereConditionBinding ? 'WHERE_' . $column : $column;
            $statement->bindValue(":" . $column, $value);
        }
    }
}
