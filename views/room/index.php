<h1>Список помещений</h1>
<a href="<?= app()->route->getUrl('/rooms/create') ?>" class="create" >Добавить помещение</a>

<form method="get" action="<?= app()->route->getUrl('/rooms') ?>">
    <div class="form">
        <select name="building_id">
            <option value="">Все здания</option>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->id ?>"
                    <?= $selectedBuilding == $building->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($building->name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="search" placeholder="Поиск по названию..." value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit">Найти</button>
        <a href="<?= app()->route->getUrl('/rooms') ?>" class="but_for_clear">Сбросить</a>
    </div>
</form>


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