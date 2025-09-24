<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UsersRepository
{
    /** @var array<int, User> */
    private array $usersById = [];

    /** @var array<string, int> */
    private array $emailToId = [];

    /**
     * @param array<int, array{id:int,name:string,email:string,passwordHash:string}> $seed
     */
    public function __construct(array $seed = [])
    {
        foreach ($seed as $row) {
            $user = new User($row['id'], $row['name'], $row['email'], $row['passwordHash']);
            $this->usersById[$user->getId()] = $user;
            $this->emailToId[strtolower($user->getEmail())] = $user->getId();
        }
    }

    public function findByEmail(string $email): ?User
    {
        $key = strtolower($email);
        if (!isset($this->emailToId[$key])) {
            return null;
        }

        $id = $this->emailToId[$key];
        return $this->usersById[$id] ?? null;
    }

    public function findById(int $id): ?User
    {
        return $this->usersById[$id] ?? null;
    }

    public function addUser(User $user): bool
    {
        $emailKey = strtolower($user->getEmail());
        if (isset($this->emailToId[$emailKey])) {
            return false;
        }

        $this->usersById[$user->getId()] = $user;
        $this->emailToId[$emailKey] = $user->getId();
        return true;
    }

    public function updateUserPassword(int $id, string $newPasswordHash): bool
    {
        $user = $this->usersById[$id] ?? null;
        if ($user === null) {
            return false;
        }

        $user->setPasswordHash($newPasswordHash);
        return true;
    }

    /**
     * @return array<int, User>
     */
    public function getAll(): array
    {
        return array_values($this->usersById);
    }
}


