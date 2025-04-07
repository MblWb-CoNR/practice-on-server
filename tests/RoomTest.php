<?php

use PHPUnit\Framework\TestCase;
use Src\Application;
use Src\Settings;
use Illuminate\Database\Capsule\Manager as Capsule;

class RoomTest extends TestCase
{
    protected function setUp(): void
    {
        // Подключаем автозагрузчик
        require __DIR__ . '/../vendor/autoload.php';

        // Правильная конфигурация для Settings
        $config = [
            'app' => [
                'auth' => \Src\Auth\Auth::class,
                'identity' => \Model\User::class
            ],
            'db' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'mvc',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'path' => [
                'root' => '',
                'views' => '/../views'
            ]
        ];

        // Инициализация приложения с правильными настройками
        $app = new Application(new Settings($config));
        $GLOBALS['app'] = $app;

        // Инициализация Eloquent отдельно
        $capsule = new Capsule;
        $capsule->addConnection($config['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function testCreateRoom(): void
    {
        // Создаем тестовые данные
        $building = \Model\Building::create([
            'name' => 'Test Building',
            'address' => 'Test Address'
        ]);

        $roomType = \Model\RoomType::create([
            'name' => 'Test Type'
        ]);

        // Мокаем запрос
        $request = $this->createMock(\Src\Request::class);
        $request->method = 'POST';
        $request->method('all')->willReturn([
            'name' => 'Test Room',
            'area' => 25,
            'seats' => 10,
            'building_id' => $building->id,
            'type_id' => $roomType->id
        ]);

        // Вызываем контроллер
        $response = (new \Controller\RoomController())->create($request);

        // Проверяем результат
        $this->assertFalse($response); // Проверяем редирект (false)

        // Проверяем что комната создана в БД
        $room = \Model\Room::where('name', 'Test Room')->first();
        $this->assertNotNull($room);
        $this->assertEquals(25, $room->area);
    }

    protected function tearDown(): void
    {
        // Очищаем тестовые данные
        \Model\Room::where('name', 'like', 'Test%')->delete();
        \Model\Building::where('name', 'like', 'Test%')->delete();
        \Model\RoomType::where('name', 'like', 'Test%')->delete();
    }
}