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
        return (new View())->render('building.index', ['building' => $buildings]);
    }

    public function create(Request $request): string
    {
        if ($request->method === 'POST' && Building::create($request->all())) {
            app()->route->redirect('/building');
        }
        return new View('building.create');
    }

    public function rooms(Request $request): string
    {
        $building = Building::find($request->id);
        return (new View())->render('building.rooms', ['building' => $building]);
    }

    public function stats(): string
    {
        $buildings = Building::with('rooms')->get();
        return (new View())->render('building.stats', ['building' => $buildings]);
    }
}