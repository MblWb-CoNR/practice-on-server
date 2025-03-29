<h1>Добавить помещение</h1>

<form method="post">
    <label>Название/номер:
        <input type="text" name="name" required>
    </label>
    <label>Тип помещения:
        <select name="type_id" required>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type->id ?>"><?= htmlspecialchars($type->name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Площадь:
        <input type="number" name="area" required>
    </label>
    <label>Количество мест:
        <input type="number" name="seats" required>
    </label>
    <label>Здание:
        <select name="bidding_id" required>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->id ?>"><?= htmlspecialchars($building->name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Добавить</button>
</form>
