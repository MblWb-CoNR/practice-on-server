<?php

namespace Controller;

use Model\Room;
use Model\RoomType;
use Model\Building;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class RoomController
{
    public function index(Request $request): string
    {
        // Получаем все здания для выпадающего списка
        $buildings = Building::all();

        // Начинаем запрос с подгрузкой связанных данных
        $query = Room::query()->with(['building', 'type']);

        // Получаем параметры фильтрации
        $buildingId = $request->get('building_id');
        $searchQuery = trim($request->get('search', ''));

        // Фильтрация по зданию (если выбрано)
        if ($buildingId && is_numeric($buildingId)) {
            $query->where('building_id', $buildingId);
        }

        // Поиск по названию помещения (если введён запрос)
        if (!empty($searchQuery)) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        }

        // Получаем отфильтрованные помещения
        $rooms = $query->get();

        return (new View())->render('room.index', [
            'rooms' => $rooms,
            'buildings' => $buildings,
            'selectedBuilding' => $buildingId,
            'searchQuery' => $searchQuery
        ]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST' && Room::create($request->all())) {
            app()->route->redirect('/rooms');
        }
        $types = RoomType::all();
        $buildings = Building::all();
        return new View('room.create', ['types' => $types, 'buildings' => $buildings]);
    }
}