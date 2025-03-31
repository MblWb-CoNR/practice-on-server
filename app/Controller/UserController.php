<?php

namespace Controller;

use Model\User;
use Model\Role;
use Src\View;
use Src\Request;
use Src\Auth\Auth;

class UserController
{
    public function index(): string
    {
        $users = User::all();
        return (new View())->render('user.index', ['users' => $users]);
    }

    public function create(Request $request): string
    {
        $roles = Role::all(); // Получаем все роли из базы

        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/users');
        }

        return (new View())->render('user.create', ['roles' => $roles]);
    }
}