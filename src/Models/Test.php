<?php

namespace App\Models;

class Test extends Entity
{
    protected ?int $idAuthor;
    protected ?string $author;
    protected string $name;
    protected int $questionsCount;

    public function getIdAuthor(): ?int
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(?int $idAuthor): void
    {
        $this->__set('idAuthor', $idAuthor);
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): void
    {
        $this->__set('author', $author);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->__set('name', $name);
    }

    public function getQuestionsCount(): int
    {
        return $this->questionsCount;
    }

    public function setQuestionsCount(int $questionsCount): void
    {
        $this->__set('questionsCount', $questionsCount);
    }
}
