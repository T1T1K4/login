# Sistema de Usuários (PHP puro)

Projeto simples para cadastro, login e reset de senha usando PHP, POO e boas práticas (PSR-12, DRY, KISS). Dados simulados em arrays (sem banco). Ideal para rodar no XAMPP.

## Integrantes
- Nome 1 — RA 1
- Nome 2 — RA 2

## Requisitos
- PHP 8.1+
- XAMPP (Apache + PHP) ou PHP embutido

## Como executar

### Via XAMPP (recomendado)
1. Copie a pasta do projeto para o diretório do servidor (ex.: `C:\xampp\htdocs\usuarios`).
2. Inicie o Apache no XAMPP.
3. Acesse `http://localhost/usuarios/public/`.

### Via servidor embutido do PHP
```bash
php -S localhost:8000 -t public
```
Acesse `http://localhost:8000`.

## Estrutura
```
src/
  Models/User.php
  Repositories/UsersRepository.php
  Services/UserManager.php
  Services/Validator.php
  seed.php
public/
  index.php
autoload.php
README.md
```

## Funcionalidades
- Cadastro de usuário com validação de e-mail e senha forte
- Login com `password_verify`
- Reset de senha com `password_hash`
- Dados em memória (arrays)

## Regras de Negócio
- E-mail válido (RFC) usando `filter_var`.
- Senha forte: mínimo 8 caracteres, ao menos 1 número e 1 maiúscula.
- Não permite e-mails duplicados.

## Casos de Uso (executados em `public/index.php`)
- Caso 1 — Cadastro válido: Maria, `maria@email.com`, `Senha123` → sucesso.
- Caso 2 — Cadastro com e-mail inválido: `pedro@@email` → “E-mail inválido”.
- Caso 3 — Login com senha errada: `joao@email.com` + `Errada123` → “Credenciais inválidas”.
- Caso 4 — Reset de senha válido: id `1`, nova senha `NovaSenha1` → sucesso.
- Caso 5 — Cadastro com e-mail duplicado: e-mail já usado (`maria@email.com`) → “E-mail já está em uso”.

## Notas de Implementação
- Código segue PSR-12 (declarações strict_types, namespaces, classes coesas).
- PSR-4 simples via `autoload.php`.
- Sem frameworks.

## Licença
Uso acadêmico.
