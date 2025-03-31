<h1>Добавить новое здание</h1>

<a href=" <?= app()->route->getUrl('/buildings/create') ?>" class="button">Добавить новое здание</a>

<form method="post">
    <label>Название:
        <input type="text" name="name" required>
    </label>
    <label>Адрес:
        <input type="text" name="address" required>
    </label>
    <button type="submit">Добавить</button>
</form>