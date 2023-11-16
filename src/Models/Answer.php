<?php

namespace App\Models;

class Answer extends Entity
{
    protected int $idQuestion;
    protected string $name;

    public function getIdQuestion(): int
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(int $idQuestion): void
    {
        $this->__set('idQuestion', $idQuestion);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->__set('name', $name);
    }
}
