<?php
declare(strict_types=1);

namespace App\Services;

class Validator
{
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function isStrongPassword(string $password): bool
    {
        if (strlen($password) < 8) {
            return false;
        }

        $hasNumber = (bool) preg_match('/\d/', $password);
        $hasUppercase = (bool) preg_match('/[A-Z]/', $password);

        return $hasNumber && $hasUppercase;
    }
}


