
<head>
    <title>register</title>
    <link rel="stylesheet" type="text/css" href="/resources/css/errors.css">
</head>

<body>
<h2>Registration</h2>
<?= getErrorsHtml() ?>

<form action="ajax/registerPost" method="POST">
    <p>
        <label for="login">Login:<br></label>
        <input id="login" name="login" type="text" value="<?=getPostFields('postLogin')?>">
    </p>
    <p>
        <label for="mail">Mail:<br></label>
        <input id="mail" name="mail" type="text" value="<?= getPostFields('postMail')?>">
    </p>

    <p>
        <label for="password">Password:<br></label>
        <input id="password" name="password" type="password">
    </p>
    <p>
        <label for="conf_password">Confirm password:<br></label>
        <input id="conf_password" name="conf_password" type="password">
    </p>
    <p>
        <input type="submit" name="submit" value="Register">

    </p>
</form>
</body>

