<h1>Добавление пользователя</h1>

<form method="post">
    <label>Имя:
        <input type="text" name="name" required>
    </label>
    <label>Логин:
        <input type="text" name="login" required>
    </label>
    <label>Пароль:
        <input type="password" name="password" required>
    </label>
    <label>Роль:
        <select name="role_id" required>
            <?php foreach ($roles as $role): ?>
                <option value="<?= $role->id ?>"><?= htmlspecialchars($role->name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Добавить</button>
</form>
