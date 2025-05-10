<?php

namespace Controller;

use Model\Building;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class BuildingController
{
    public function index(): string
    {
        $buildings = Building::all();
        return (new View())->render('building.index', ['buildings' => $buildings]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST') {
            // Получаем ID текущего пользователя
            $userId = app()->auth::user()->id;

            // Добавляем user_id в данные
            $data = $request->all();
            $data['user_id'] = $userId;

            if (Building::create($data)) {
                app()->route->redirect('/buildings');
            }
        }
        return new View('building.create');
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