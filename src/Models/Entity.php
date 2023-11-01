<?php

namespace App\Models;

class Entity
{
    protected array $modifiedProperties = [];

    public function __set($name, $value)
    {
        $this->$name = $value;
        array_push($this->modifiedProperties, $name);
    }

    public function getModifiedProperties(): array
    {
        return $this->modifiedProperties;
    }
}
