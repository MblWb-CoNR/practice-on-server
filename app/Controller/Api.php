<?php

namespace Controller;

use Model\Building;
use Src\Request;
use Src\View;

class Api
{
    public function index(): void
    {
        $buildings = Building::all()->toArray();
        (new View())->toJSON($buildings);
    }

    public function protectedData(Request $request): void
    {
        // Только для авторизованных пользователей
        $user = app()->auth->user();
        $data = [
            'user' => $user->toArray(),
            'buildings' => Building::where('user_id', $user->id)->get()->toArray()
        ];

        (new View())->toJSON($data);
    }
}
