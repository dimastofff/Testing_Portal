<?php

namespace App\Models;

class Question extends Entity
{
    protected int $idTest;
    protected string $name;
    protected ?int $idCorrectAnswer;

    public function getIdTest(): int
    {
        return $this->idTest;
    }

    public function setIdTest(int $idTest): void
    {
        $this->__set('idTest', $idTest);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->__set('name', $name);
    }

    public function getIdCorrectAnswer(): ?int
    {
        return $this->idCorrectAnswer;
    }

    public function setIdCorrectAnswer(?int $idCorrectAnswer): void
    {
        $this->__set('idCorrectAnswer', $idCorrectAnswer);
    }
}

