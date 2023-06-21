<header class="header">
    <?php if (empty($_SESSION['userLogin'])) : ?>
        <a href="/register">Sign up</a>
        <a href="/login">Sign in</a>
    <?php else : ?>
        <a href="/logout">Log out</a>
    <?php endif; ?>
</header>