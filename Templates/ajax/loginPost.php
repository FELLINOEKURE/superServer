<?php

declare(strict_types=1);

use Connection\MysqliConnection;
use Connection\User;
use Connection\UserManagement;


if (!isPost())
{
redirect('/login');
}
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($login)) {
    addError('Please enter login');
}
if (empty($password)) {
    addError('Please enter password');
}
if (hasErrors()) {
    redirect('/login');
}
if (!UserManagement::authorize($login, $password)) {
    addError('Please check your credentials!');
    redirect('/login');
}



