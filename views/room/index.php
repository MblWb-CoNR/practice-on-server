<h1>Список помещений</h1>

<?php if (app()->auth::user()->role_id == 2): ?>
    <a href="<?= app()->route->getUrl('/rooms/create') ?>">Добавить помещение</a>
<?php endif; ?>

<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Тип</th>
        <th>Площадь</th>
        <th>Мест</th>
        <th>Здание</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= htmlspecialchars($room->name) ?></td>
            <td><?= htmlspecialchars($room->type->name) ?></td>
            <td><?= $room->area ?> м²</td>
            <td><?= $room->seats ?></td>
            <td><?= htmlspecialchars($room->building->name) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>