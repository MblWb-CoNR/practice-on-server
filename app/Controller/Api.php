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

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }
}
