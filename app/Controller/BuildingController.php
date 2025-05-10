<?php

namespace Controller;

use Model\Building;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class BuildingController
{
    public function index(): string
    {
        $buildings = Building::all();
        return (new View())->render('building.index', ['buildings' => $buildings]);
    }

    public function create(Request $request): string
    {

        $users = User::all();
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'unique:buildings,name', 'max:225'],
                'address' => ['required', 'min:1', 'max:500'],
                'user_id' => ['required', 'exists:users,id']
            ], [
                'required' => 'Поле обязательно для заполнения',
                'unique' => 'Здание с таким названием уже существует',
                'exists' => 'Выбранный пользователь не существует',
                'min' => 'Минимум :min символов',
                'max' => 'Максимум :max символов'
            ]);



            if ($validator->fails()) {
                // Получаем текущего пользователя для select-опции
                $users = User::all();
                return new View('building.create', [
                    'errors' => $validator->errors(),
                    'users' => $users,
                    'old' => $request->all()
                ]);
            }

            // Добавляем user_id текущего пользователя, если не указан
            $data = $request->all();
            if (empty($data['user_id'])) {
                $data['user_id'] = app()->auth::user()->id;
            }

            var_dump($request);

            if (Building::create($data)) {
                app()->route->redirect('/buildings');
            }
        }
        return new View('building.create', ['users' => $users]);
    }

    public function rooms(Request $request): string
    {
        $building = Building::find($request->id);
        if (!$building) {
            app()->route->redirect('/buildings');
        }

        $rooms = $building->rooms()->with('type')->get();
        return (new View())->render('building.rooms', [
            'building' => $building,
            'rooms' => $rooms
        ]);
    }

    public function stats(): string
    {
        $buildings = Building::with(['rooms' => function($query) {
            $query->where('type_id', 1);
        }])->get();
        $totalArea = $buildings->sum(function($building) {
            return $building->rooms->sum('area');
        });
        $totalSeats = $buildings->sum(function($building) {
            return $building->rooms->sum('seats');
        });

        return (new View())->render('building.stats', [
            'buildings' => $buildings,
            'totalArea' => $totalArea,
            'totalSeats' => $totalSeats
        ]);
    }
}