<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/main.css">
    <title>Деканат университета X</title>
</head>
<body>
<header>
    <img src="../../public/img/logo.svg" alt="uni">
    <nav>
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <a href="<?= app()->route->getUrl('/functions')?>" >Функции</a>
        <a href="<?= app()->route->getUrl('/buildings')?>">Здания</a>
        <a href="<?= app()->route->getUrl('/rooms')?>">Помещения</a>
        <?php if (app()->auth::user()->role_id == 1): ?>
            <a href="<?= app()->route->getUrl('/users')?>">Пользователи</a>
        <?php endif; ?>
        <?php
        if (!app()->auth::check()):
            ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
            <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
        <?php
        else:
            ?>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
        <?php
        endif;
        ?>

    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>