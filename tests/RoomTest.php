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
        require __DIR__ . '/../core/bootstrap.php'; // Добавленная строка

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

        $_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../public');
        $_SERVER['REQUEST_URI'] = '/';
    }

    public function testCreateRoom(): void
    {
        // Подготовка данных
        $user = \Model\User::first();
        if (!$user) {
            $this->markTestSkipped('No users found in database');
        }

        $building = \Model\Building::create([
            'name' => 'Test Building',
            'address' => 'Test Address',
            'user_id' => $user->id
        ]);

        $roomType = \Model\RoomType::create([
            'name' => 'Test Type'
        ]);

        // Тест успешного создания
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

        // Проверяем, что комната создана
        $room = \Model\Room::where('name', 'Test Room')->first();
        $this->assertNotNull($room);

        // Тест с ошибками валидации
        $invalidRequest = $this->createMock(\Src\Request::class);
        $invalidRequest->method = 'POST';
        $invalidRequest->method('all')->willReturn([
            'name' => '', // невалидное имя
            'area' => 0, // невалидная площадь
            'seats' => 0, // невалидное количество мест
            'building_id' => $building->id,
            'type_id' => $roomType->id
        ]);

        $response = (new \Controller\RoomController())->create($invalidRequest);
        $this->assertInstanceOf(\Src\View::class, $response); // Проверяем возврат View с ошибками
    }

//    protected function tearDown(): void
//    {
//        \Model\Room::where('name', 'Test Room')->delete();
//        \Model\Building::where('name', 'Test Building')->delete();
//        \Model\RoomType::where('name', 'Test Type')->delete();
//    }
}