<?php

declare(strict_types=1);

use Connection\MysqliConnection;
use Connection\User;



if (!isPost())
{
redirect('/login');
}
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;