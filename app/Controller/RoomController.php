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
    public function index(): string
    {
        $rooms = Room::with(['building', 'type'])->get();
        return (new View())->render('room.index', ['rooms' => $rooms]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            $data['building_id'] = $data['building_id'];
            if (Room::create($data)) {
                app()->route->redirect('/rooms');
            }
        }
        $types = RoomType::all();
        $buildings = Building::all();
        return new View('room.create', [
            'types' => $types,
            'buildings' => $buildings
        ]);
    }
}