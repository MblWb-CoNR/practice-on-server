<h1>Помещения в здании: <?= htmlspecialchars($building->name) ?></h1>

<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Тип</th>
        <th>Площадь</th>
        <th>Мест</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= htmlspecialchars($room->name) ?></td>
            <td><?= htmlspecialchars($room->type->name) ?></td>
            <td><?= $room->area ?> м²</td>
            <td><?= $room->seats ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="/buildings">Назад к списку зданий</a>