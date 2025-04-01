<h1>Список зданий</h1>

<a href="<?= app()->route->getUrl('/buildings/create') ?>" class="create">Добавить здание</a>

<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Адрес</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= htmlspecialchars($building->name) ?></td>
            <td><?= htmlspecialchars($building->address) ?></td>
            <td>
                <a href="<?= app()->route->getUrl('/rooms?building_id=' . $building->id) ?>">Показать помещения или найти</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>