<?php
/**
 * @var array $formData
 */
?>
<head>
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="/resources/css/errors.css">
</head>

<body>
<h2>Authorization</h2>
<?= getErrorsHtml() ?>

<form action="ajax/loginPost" method="POST">
    <p>
        <label for="login">Inter Login:<br></label>
        <input id="login" name="login" type="text" value="<?= $formData['login'] ?? '' ?>">
    </p>
    <p>
        <label for="password">Inter password:<br></label>
        <input id="password" name="password" type="password">
    </p>
    <p>
    <input type="submit" name="submit" value="sign in">

    </p>



</form>
</body>