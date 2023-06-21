<?php

use Connection\MysqliConnection;

function isPost(): bool {

    return $_SERVER['REQUEST_METHOD'] === 'POST';

}

function redirect(string $path = '/'): never
{
    header("Location: $path");

    exit();
}
function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
function getErrorsHtml(): string
{
    if (empty($_SESSION['errors'])){
        return '';
    }
    $containerTmpl = '<div class="errors">%s</div>';
    $errorTmpl = '<div class="error"><span>%s</span></div>';
    $buffer ='';
    foreach ($_SESSION['errors'] as $error) {
        $buffer .= sprintf($errorTmpl, $error);
    }
    $_SESSION['errors'] = [];
    return sprintf($containerTmpl, $buffer);

}
function selectFields(string $field, string $postField): bool {
    $selectField = MysqliConnection::getInstance()->query(
        sprintf('SELECT id FROM %s WHERE %s= "%s"', 'User',
            $field, (string)$postField)
    );
    $fieldId = $selectField->fetch_array();
    return empty(($fieldId['id']));

}

function saveFormData(): void
{
    $_SESSION['formData'] = $_POST;
}
function restoreFormData(): array
{
    $data = $_SESSION['formData'] ?? [];
    unset($_SESSION['formData']);
    return $data;
}
function addError(string $error): void
{
    $_SESSION['errors'][] = $error;
}
function hasErrors(): bool {
    return !empty($_SESSION['errors']);
}




