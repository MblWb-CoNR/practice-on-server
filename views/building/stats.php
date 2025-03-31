<h1>Статистика по площадям и местам</h1>

<table>
    <thead>
    <tr>
        <th>Здание</th>
        <th>Общая площадь (м²)</th>
        <th>Всего мест</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($buildings as $building): ?>
        <tr>
            <td><?= htmlspecialchars($building->name) ?></td>
            <td><?= $building->rooms->sum('area') ?></td>
            <td><?= $building->rooms->sum('seats') ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href=" <?= app()->route->getUrl('/functions') ?>">Назад к функциям</a>