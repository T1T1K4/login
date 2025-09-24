<?php
declare(strict_types=1);

use App\Repositories\UsersRepository;

require __DIR__ . '/../autoload.php';

// Initial fixed users (simulate DB) with a single user João Silva
$seed = [
    [
        'id' => 1,
        'name' => 'João Silva',
        'email' => 'joao@email.com',
        'passwordHash' => password_hash('SenhaForte1', PASSWORD_DEFAULT),
    ],
];

$repository = new UsersRepository($seed);

return $repository;


