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
        $roles = Role::all();

        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/users');
        }

        // Явно вызываем метод render() для преобразования View в строку
        return (new View('user.create', ['roles' => $roles]))->render();
    }
}