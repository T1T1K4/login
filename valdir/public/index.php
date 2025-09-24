<?php
declare(strict_types=1);

use App\Services\UserManager;

require __DIR__ . '/../autoload.php';

/** @var \App\Repositories\UsersRepository $repository */
$repository = require __DIR__ . '/../src/seed.php';
$manager = new UserManager($repository);

header('Content-Type: text/plain; charset=utf-8');

function line(string $title, array $result): void
{
    echo $title . " -> " . ($result['success'] ? 'OK' : 'ERRO') . ' — ' . $result['message'] . PHP_EOL;
}

echo "Teste de funcionalidades (5 casos)" . PHP_EOL;
echo str_repeat('-', 50) . PHP_EOL;

// Caso 1 — Cadastro válido
$r1 = $manager->registerUser('Maria Oliveira', 'maria@email.com', 'Senha123');
line('Caso 1 — Cadastro válido', $r1);

// Caso 2 — Cadastro com e-mail inválido
$r2 = $manager->registerUser('Pedro', 'pedro@@email', 'Senha123');
line('Caso 2 — E-mail inválido', $r2);

// Caso 3 — Tentativa de login com senha errada
$r3 = $manager->login('joao@email.com', 'Errada123');
line('Caso 3 — Login com senha errada', $r3);

// Caso 4 — Reset de senha válido
$r4 = $manager->resetPassword(1, 'NovaSenha1');
line('Caso 4 — Reset de senha válido', $r4);

// Caso 5 — Cadastro de usuário com e-mail duplicado
$r5 = $manager->registerUser('Outro Nome', 'maria@email.com', 'Senha123');
line('Caso 5 — E-mail duplicado', $r5);

echo str_repeat('-', 50) . PHP_EOL;


