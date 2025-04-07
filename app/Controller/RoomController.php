<?php

namespace Controller;

use Model\Room;
use Model\RoomType;
use Model\Building;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class RoomController
{
    public function index(Request $request): string
    {
        $buildings = Building::all();

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
        $types = RoomType::all();
        $buildings = Building::all();
        if ($request->method === 'POST' && Room::create($request->all())) {
            app()->route->redirect('/rooms');
            $validator = new Validator($request->all(), [
                    'name' => ['required', 'unique:rooms,name', 'max:255'],
                    'area' => ['required', 'numeric', 'min:1', 'max:1000'],
                    'seats' => ['required', 'integer', 'min:1', 'max:500'],
                    'building_id' => ['required', 'exists:buildings,id'],
                    'type_id' => ['required', 'exists:room_types,id']
                ], [
                    'required' => 'Поле обязательно',
                    'unique' => 'Помещение уже существует',
                    'exists' => 'Выбранное значение не найдено',
                    'numeric' => 'Должно быть числом (например: 25.5)',
                    'integer' => 'Должно быть целым числом',
                    'min' => 'Не может быть меньше :min',
                    'max' => 'Не может быть больше :max'
            ]);

            if ($validator->fails()) {
                return new View('room.create', [
                    'errors' => $validator->errors(),
                    'types' => $types,
                    'buildings' => $buildings,
                    'old' => $request->all() // Сохраняем введённые данные
                ]);
            }

            // Если валидация прошла - создаём запись
            if (Room::create($request->all())) {
                app()->route->redirect('/rooms');
            }
        }
        return new View('room.create', ['types' => $types, 'buildings' => $buildings]);
    }
}