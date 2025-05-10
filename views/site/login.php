<h2>Авторизация</h2>
<h3><?= $message ?? ''; ?></h3>

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
    ?>
    <form method="post" action="<?= app()->route->getUrl('/login') ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
        <label>Логин
            <input type="text" name="login">
        </label>
        <label>Пароль
            <input type="password" name="password">
        </label>
        <button>Войти</button>
    </form>
<?php endif;
