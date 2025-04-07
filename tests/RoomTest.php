<?php

use PHPUnit\Framework\TestCase;
use Src\Application;
use Src\Settings;
use Illuminate\Database\Capsule\Manager as Capsule;

class RoomTest extends TestCase
{
    protected function setUp(): void
    {
        require __DIR__ . '/../vendor/autoload.php';

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

        $app = new Application(new Settings($config));
        $GLOBALS['app'] = $app;

        $capsule = new Capsule;
        $capsule->addConnection($config['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function testCreateRoom(): void
    {
        // Получаем первого существующего пользователя
        $user = \Model\User::first();
        if (!$user) {
            $this->markTestSkipped('No users found in database');
        }

        // Создаем тестовое здание с валидным user_id
        $building = \Model\Building::create([
            'name' => 'Test Building',
            'address' => 'Test Address',
            'user_id' => $user->id // Используем существующего пользователя
        ]);

        $roomType = \Model\RoomType::create([
            'name' => 'Test Type'
        ]);

        $request = $this->createMock(\Src\Request::class);
        $request->method = 'POST';
        $request->method('all')->willReturn([
            'name' => 'Test Room',
            'area' => 25,
            'seats' => 10,
            'building_id' => $building->id,
            'type_id' => $roomType->id
        ]);

        $response = (new \Controller\RoomController())->create($request);

        $this->assertFalse($response); // Проверяем редирект

        $room = \Model\Room::where('name', 'Test Room')->first();
        $this->assertNotNull($room);
    }

    protected function tearDown(): void
    {
        // Удаляем только тестовые данные (по префиксу Test)
        \Model\Room::where('name', 'Test Room')->delete();
        \Model\Building::where('name', 'Test Building')->delete();
        \Model\RoomType::where('name', 'Test Type')->delete();
    }
}