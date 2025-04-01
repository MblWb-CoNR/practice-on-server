<h1>Список пользователей</h1>

<?php if (app()->auth::user()->role_id == 1): ?>
    <a href="<?= app()->route->getUrl('/users/create') ?>" class="create">Добавить пользователя</a>
<?php endif; ?>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Логин</th>
        <th>Роль</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= htmlspecialchars($user->name) ?></td>
            <td><?= htmlspecialchars($user->login) ?></td>
            <td><?= $user->role_id == 1 ? 'Администратор' : 'Сотрудник' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>