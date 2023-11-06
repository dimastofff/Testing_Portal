<?php

namespace App\Utils;

use App\Models\Entity;

class SqlGenerator
{
    public static function generateSelectSql(Entity $entity, array $variables = null): string
    {
        if (isset($variables)) {
            $whereSqlPart = ' WHERE '.join(' AND ', array_map(fn($column, $value) => $column . ' = :' . $column, array_keys($variables), $variables));
        } else {
            $whereSqlPart = '';
        }
        return 'SELECT * FROM '
            . self::getTableName($entity)
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

    public static function generateUpdateSql(Entity $entity, array $variables): string
    {
        $variables = isset($variables['WHERE']) ? $variables['WHERE'] : $variables;
        return 'UPDATE '
            . self::getTableName($entity)
            . ' SET '
            . join(', ', array_map(fn($column, $value) => $column . ' = :' . $column, self::getTableColumns($entity), self::getTableColumns($entity)))
            . ' WHERE '
            . join(' AND ', array_map(fn($column, $value) => $column . ' = :WHERE_' . $column, array_keys($variables), $variables));
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
        $properties = $entity->getModifiedProperties();
        return array_map(fn($property) => $property, $properties);
    }

    private static function getTableBindings(Entity $entity): array
    {
        $tableColumns = self::getTableColumns($entity);
        return array_map(fn($column) => ':' . $column, $tableColumns);
    }
}
