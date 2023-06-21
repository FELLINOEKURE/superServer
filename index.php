<?php

declare(strict_types=1);

session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

spl_autoload_register(static function ($className) {
    $filename = str_replace('\\', '/', $className);

    require_once $filename . '.php';
});

include "functions.php";

$formData = [];

if (isPost()) {
    saveFormData();
} else {
    $formData = restoreFormData();
}

if ($_SERVER['REQUEST_URI'] === '/') {
    $template = 'homepage';
} else {
    $template = trim($_SERVER['REQUEST_URI'], '/');
}

ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>super server</title>
    <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
    <link rel="stylesheet" type="text/css" href="resources/css/errors.css">
</head>
<body>
<?php include_once "Templates/header.php"; ?>
<div class="page-wrapper ">
    <div class="error errors"><?= getErrorsHtml() ?></div>
    <?php include_once "Templates/$template.php"; ?>
</div>
<?php include_once "Templates/footer.php"; ?>

</body>

</html>
<?php ob_end_flush(); ?>











