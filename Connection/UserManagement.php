<?php

declare(strict_types=1);

namespace Connection;

use Interfaces\UserManagementInterface;

class UserManagement implements UserManagementInterface
{

    public static function authorize(string $login, string $password): bool
    {
        $result = MysqliConnection::getInstance()->query(
            sprintf('SELECT * FROM %s WHERE %s= "%s"', 'User',
                'login', (string)$login)
        );
        if (!$result->num_rows) {
            return false;
        }
        $userData = $result->fetch_assoc();

        if ($userData['password'] === $password){
            $_SESSION['id'] = $userData['id'];
            return true;
        }
        return false;
    }
}