<?php

declare(strict_types=1);

session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

spl_autoload_register(function ($className) {
    $filename = str_replace('\\', '/', $className);

    require_once $filename . '.php';
});

include "functions.php";

if ($_SERVER['REQUEST_URI'] === '/') {
    $template = 'homepage';
} else {
    $template = trim($_SERVER['REQUEST_URI'], '/');
}
include "Templates/$template.php";













