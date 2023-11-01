<?php

namespace App\Models;

class User extends Entity
{
    protected int $id;
    protected string $email;
    protected string $password;
    protected string $role;
    protected string $emailConfirmationHash;
    protected string $createdAt;
    protected string $updatedAt;
    protected ?string $emailConfirmedAt;
    protected ?string $lastLoginAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->__set("email", $email);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->__set("password", password_hash($password, PASSWORD_BCRYPT));
    }

    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->__set("role", $role);
    }

    public function getEmailConfirmationHash(): string
    {
        return $this->emailConfirmationHash;
    }

    public function setEmailConfirmationHash(string $emailConfirmationHash): void
    {
        $this->__set("emailConfirmationHash", $emailConfirmationHash);
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

    public function getEmailConfirmedAt(): ?string
    {
        return $this->emailConfirmedAt;
    }

    public function setEmailConfirmedAt(string $emailConfirmedAt): void
    {
        $this->__set("emailConfirmedAt", $emailConfirmedAt);
    }

    public function getLastLoginAt(): ?string
    {
        return $this->lastLoginAt;
    }

    public function setLastLoginAt(string $lastLoginAt): void
    {
        $this->__set("lastLoginAt", $lastLoginAt);
    }
}
