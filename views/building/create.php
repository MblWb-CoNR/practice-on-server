<h1>Добавить новое здание</h1>

<form method="post" action="<?= app()->route->getUrl('/buildings/create') ?>" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <label>Название:
        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" class="<?= isset($errors['name']) ? 'is-invalid' : '' ?>">
        <?php if (isset($errors['name'])): ?>
            <div class="error_message">
                <?= implode('<br>', (array)$errors['name']) ?>
            </div>
        <?php endif; ?>
    </label>
    <label>Адрес:
        <input type="text" name="address" class="<?= isset($errors['address']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['address'] ?? '') ?>">
        <?php if (isset($errors['address'])): ?>
            <div class="error_message">
                <?= implode('<br>', (array)$errors['address']) ?>
            </div>
        <?php endif; ?>
    </label>
    <button type="submit">Добавить</button>
</form>