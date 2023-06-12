<?php

declare(strict_types=1);

use Connection\MysqliConnection;
use Connection\User;



if (!isPost())
{
    redirect('/register');
}

$login = $_POST['login'] ?? null;
$mail = $_POST['mail'] ?? null;
$password = $_POST['password'] ?? null;
$conf_password = $_POST['conf_password'] ?? null;
$_SESSION['postLogin'][] = $_POST['login'];
$_SESSION['postMail'][] = $_POST['mail'];
$user = new User();
MysqliConnection::createEntityTable($user);
$login = trim($login);
$mail = trim($mail);
$password = trim($password);
$conf_password = trim($conf_password);

if (!($login && $mail && $password && $conf_password )){
    $_SESSION['errors'][] = 'Please fill all the fields';
    redirect('/register');
}
if ($password !== $conf_password) {
    $_SESSION['errors'][] = 'The password and confirm password fields do not match.';
    redirect('/register');
}
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
    $_SESSION['errors'][] = 'Invalid email format';
    redirect('/register');
}
$selectLogin = MysqliConnection::getInstance()->query(
    sprintf('SELECT id FROM %s WHERE %s= "%s"', 'User',
        'login', (string)$login)
);
$loginId = $selectLogin->fetch_array();
if (!empty($loginId['id'])){
    $_SESSION['errors'][] = 'Login is registered';
    redirect('/register');
}
$selectMail = MysqliConnection::getInstance()->query(
    sprintf('SELECT id FROM %s WHERE %s= "%s"', 'User',
        'mail', (string)$mail)
);
$mailId = $selectMail->fetch_array();
if (!empty($mailId['id'])){
    $_SESSION['errors'][] = 'Mail is registered';
    redirect('/register');
}

$login =  MysqliConnection::getInstance()->real_escape_string($_POST['login']);
$mail =  MysqliConnection::getInstance()->real_escape_string($_POST['mail']);
$password =  MysqliConnection::getInstance()->real_escape_string($_POST['password']);
$conf_password = MysqliConnection::getInstance()->real_escape_string($_POST['conf_password']);
$user->setLogin($login);
$user->setMail($mail);
$user->setPassword($password);

MysqliConnection::save($user);






?>

<div>hello regiset</div>
