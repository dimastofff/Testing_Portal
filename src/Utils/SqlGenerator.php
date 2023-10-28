<?php

namespace App\Utils;

use App\Models\Entity;

class SqlGenerator
{
    public static function generateSelectSql(Entity $entity, array $variables): string
    {
        $whereSqlPart = join(' AND ', array_map(fn($column, $value) => $column . ' = :' . $column, array_keys($variables), $variables));
        return 'SELECT * FROM '
            . self::getTableName($entity)
            . ' WHERE '
            . $whereSqlPart;
    }

    public static function generateInsertSql(Entity $entity): string
    {
        return 'INSERT INTO '
            . self::getTableName($entity)
            . ' ('
            . join(', ', self::getTableColumns($entity))
            . ') VALUES ('
            . join(', ', self::getTableBindings($entity))
            . ')';
    }

    public static function getEntityPropertyValue(Entity $entity, string $property): mixed
    {
        $getter = 'get' . ucwords($property);
        return $entity->$getter();
    }

    private static function getTableName(Entity $entity): string
    {
        $reflection = new \ReflectionClass($entity::class);
        return strtolower($reflection->getShortName()) . 's';
    }

    private static function getTableColumns(Entity $entity): array
    {
        $reflection = new \ReflectionClass($entity::class);
        $properties = $reflection->getProperties();
        return array_map(fn($property) => $property->getName(), $properties);
    }

    private static function getTableBindings(Entity $entity): array
    {
        $tableColumns = self::getTableColumns($entity);
        return array_map(fn($column) => ':' . $column, $tableColumns);
    }
}
