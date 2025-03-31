<h1>Список зданий</h1>

<a href="/buildings/create">Добавить здание</a>

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
                <a href="/buildings/rooms?id=<?= $building->id ?>">Помещения</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
