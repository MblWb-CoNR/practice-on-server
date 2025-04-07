<?php
//Путь до директории с конфигурационными файлами
const DIR_CONFIG = '/../config';

echo '<pre>Session: '; print_r($_SESSION); echo '</pre>';

//Подключение автозагрузчика composer
require_once __DIR__ . '/../vendor/autoload.php';

//Функция, возвращающая массив всех настроек приложения
function getConfigs(string $path = DIR_CONFIG): array
{
    $settings = [];
    foreach (scandir(__DIR__ . $path) as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name)) {
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

require_once __DIR__ . '/../route/web.php';
$app = new Src\Application(require __DIR__ . '/../config/app.php');

//Подключение хелперов
require_once __DIR__ .  '/../core/helpers.php';

return $app;