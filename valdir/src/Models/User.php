<?php
declare(strict_types=1);

namespace App\Models;

class User
{
    private int $id;

    private string $name;

    private string $email;

    private string $passwordHash;

    public function __construct(int $id, string $name, string $email, string $passwordHash)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }
}


