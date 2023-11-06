<?php

namespace App\Models;

class Entity
{
    protected array $modifiedProperties = [];
    protected int $id;
    protected string $createdAt;
    protected string $updatedAt;

    public function __set($name, $value)
    {
        $this->$name = $value;
        array_push($this->modifiedProperties, $name);
    }

    public function getModifiedProperties(): array
    {
        return $this->modifiedProperties;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->__set("createdAt", $createdAt);
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->__set("updatedAt", $updatedAt);
    }
}
