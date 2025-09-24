<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UsersRepository;

class UserManager
{
    public function __construct(
        private UsersRepository $repository
    ) {
    }

    /**
     * @return array{success:bool,message:string}
     */
    public function registerUser(string $name, string $email, string $password): array
    {
        if (!Validator::isValidEmail($email)) {
            return ['success' => false, 'message' => 'E-mail inválido'];
        }

        if (!Validator::isStrongPassword($password)) {
            return ['success' => false, 'message' => 'Senha fraca'];
        }

        if ($this->repository->findByEmail($email) !== null) {
            return ['success' => false, 'message' => 'E-mail já está em uso'];
        }

        $newId = $this->generateNextId();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($newId, $name, $email, $passwordHash);

        $added = $this->repository->addUser($user);
        if (!$added) {
            return ['success' => false, 'message' => 'E-mail já está em uso'];
        }

        return ['success' => true, 'message' => 'Usuário cadastrado com sucesso'];
    }

    /**
     * @return array{success:bool,message:string}
     */
    public function login(string $email, string $password): array
    {
        $user = $this->repository->findByEmail($email);
        if ($user === null) {
            return ['success' => false, 'message' => 'Credenciais inválidas'];
        }

        if (!password_verify($password, $user->getPasswordHash())) {
            return ['success' => false, 'message' => 'Credenciais inválidas'];
        }

        return ['success' => true, 'message' => 'Login realizado com sucesso'];
    }

    /**
     * @return array{success:bool,message:string}
     */
    public function resetPassword(int $userId, string $newPassword): array
    {
        if (!Validator::isStrongPassword($newPassword)) {
            return ['success' => false, 'message' => 'Senha fraca'];
        }

        $user = $this->repository->findById($userId);
        if ($user === null) {
            return ['success' => false, 'message' => 'Usuário não encontrado'];
        }

        $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->repository->updateUserPassword($userId, $newHash);

        return ['success' => true, 'message' => 'Senha alterada com sucesso'];
    }

    private function generateNextId(): int
    {
        $max = 0;
        foreach ($this->repository->getAll() as $existingUser) {
            $max = max($max, $existingUser->getId());
        }

        return $max + 1;
    }
}


