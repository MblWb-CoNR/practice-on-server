<?php
//Путь до директории с конфигурационными файлами
const DIR_CONFIG = '/../config';

echo '<pre>Session: '; print_r($_SESSION); echo '</pre>';

//Подключение автозагрузчика composer
require_once __DIR__ . '/../vendor/autoload.php';

//Функция, возвращающая массив всех настроек приложения
function getConfigs(string $path = DIR_CONFIG): array
{
    $settings = [
//        'path' => [
//            'root' => '',             // Корень проекта относительно DOCUMENT_ROOT
//            'views' => '/../views',     // Путь к views (теперь в корне)
//        ],
    ];
    foreach (scandir(__DIR__ . $path) as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name)) {
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

require_once __DIR__ . '/../route/web.php';
$app = new Src\Application(new Src\Settings(getConfigs()));

//Функция возвращает глобальный экземпляр приложения
function app() {
    global $app;
    return $app;
}
return $app;