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
        $buildings = Building::with('rooms')->get();
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