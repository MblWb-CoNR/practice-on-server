<h1>Добавить помещение</h1>

<form method="post" action="<?= app()->route->getUrl('/rooms/create') ?>" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <?php if (isset($errors['name'])): ?>
        <div>
            <?= implode('<br>', $errors['name']) ?>
        </div>
    <?php endif ?>
    <label>Название/номер:
        <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" class="<?= isset($errors['name']) ? 'is-invalid' : '' ?>">
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
        <select name="building_id" required>
            <?php foreach ($buildings as $building): ?>
                <option value="<?= $building->id ?>"><?= htmlspecialchars($building->name) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Добавить</button>
</form>
