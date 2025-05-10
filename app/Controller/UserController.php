<?php

namespace Controller;

use Model\User;
use Model\Role;
use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Src\Validator\Validator;
use function Collect\collection;

class UserController
{
    public function index(): string
    {
        echo '<pre>';
        print_r(User::with('role')->first()->toArray());
        echo '</pre>';

        $users = collection(User::with('role')->get()->toArray())
            ->map(function ($user) {
                return [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role']['name'] ?? 'Роль не указана'
                ];
            });

        return (new View())->render('user.index', ['users' => $users]);
    }

    public function create(Request $request): string
    {
        $roles = Role::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'regex:/^[А-ЯЁа-яё -]+$/u', 'min:2', 'max:50'],
                'login' => ['required', 'unique:users,login', 'min:5', 'max:30'],
                'password' => ['required', 'min:6', 'max:100'],
                'role_id' => ['required', 'exists:roles,id']
            ], [
                'required' => 'Поле обязательно для заполнения',
                'unique' => 'Логин уже занят',
                'exists' => 'Выбранная роль не существует',
                'regex' => 'Допустимы только русские буквы, пробелы и дефисы',
                'min' => 'Минимум :min символов',
                'max' => 'Максимум :max символов'
            ]);

            if ($validator->fails()) {
                return new View('user.create', [
                    'errors' => $validator->errors(),
                    'roles' => $roles,
                    'old' => $request->all()
                ]);
            }

            $data = $request->all();
            $data['password'] = md5($data['password']); // Хешируем пароль

            if (User::create($data)) {
                app()->route->redirect('/users');
            }
        }

        return new View('user.create', ['roles' => $roles]);
    }
}