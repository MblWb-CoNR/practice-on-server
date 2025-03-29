<h1>Функции</h1>
<div class="buttons">
    <?php if (app()->auth::check()): ?>
        <?php if (app()->auth::user()->role_id == 2): ?>
            <!-- Для сотрудника деканата -->
            <a href=" <?= app()->route->getUrl('/rooms/create') ?>" class="button">Добавить новое помещение</a>
            <a href=" <?= app()->route->getUrl('/buildings/create') ?>" class="button">Добавить новое здание</a>
        <?php endif; ?>

        <!-- Для всех авторизованных пользователей -->
        <a href=" <?= app()->route->getUrl('/buildings') ?>" class="button">Выбрать название или номер помещения</a>
        <a href=" <?= app()->route->getUrl('/building/stats') ?>" class="button">Подсчет площади и количества мест</a>

        <?php if (app()->auth::user()->role_id == 1): ?>
            <!-- Только для администратора -->
            <a href=" <?= app()->route->getUrl('/users/create') ?>" class="button">Добавить нового сотрудника</a>
        <?php endif; ?>
    <?php else: ?>
        <p>Для доступа к функциям пожалуйста <a href="<?= app()->route->getUrl('/login') ?>">авторизуйтесь</a></p>
    <?php endif; ?>
</div>
