<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post" action="<?= app()->route->getUrl('/signup') ?>" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <label>Имя
        <input type="text" name="name" class="<?= isset($errors['name']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
        <?php if (isset($errors['name'])): ?>
            <div class="error_message">
                <?= implode('<br>', (array)$errors['name']) ?>
            </div>
        <?php endif; ?>
    </label>
    <label>Логин
        <input type="text" name="login" class="<?= isset($errors['login']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['login'] ?? '') ?>">
        <?php if (isset($errors['login'])): ?>
            <div class="error_message">
                <?= implode('<br>', (array)$errors['login']) ?>
            </div>
        <?php endif; ?>
    </label>
    <label>Пароль
        <input type="password" name="password" class="<?= isset($errors['password']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['password'] ?? '') ?>">
        <?php if (isset($errors['password'])): ?>
            <div class="error_message">
                <?= implode('<br>', (array)$errors['password']) ?>
            </div>
        <?php endif; ?>
    </label>
    <button>Зарегистрироваться</button>
</form>
