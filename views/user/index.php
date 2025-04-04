<h1>Список пользователей</h1>

<?php if (app()->auth::user()->role_id == 1): ?>
    <a href="<?= app()->route->getUrl('/users/create') ?>" class="create">Добавить пользователя</a>
<?php endif; ?>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Роль</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['role'] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>