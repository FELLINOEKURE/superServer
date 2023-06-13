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
$_SESSION['postLogin'][] = $_POST['login'];


if (!($login &&  $password )){
    $_SESSION['errors'][] = 'Please fill all the fields';
    redirect('/login');
}
if (selectFields('login',$login)){
    $_SESSION['errors'][] = 'Login does not exist or entered incorrectly';
    redirect('/login');
}

if (selectFields('password',$password)){
    $_SESSION['errors'][] = 'Password does not exist or entered incorrectly';
    redirect('/login');
}
$_SESSION['userLogin'] = $login;
redirect('/homepage');
