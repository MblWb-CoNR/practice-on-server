<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
    public function handle(Request $request, string $roles): void
    {
        //Если пользователь не авторизован - отправляем на страницу входа
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        $user = Auth::user();
        $role = $user->role_id;

        // Проверяем соответствие ролей
        if ($roles === 'admin' && $role != 1) {
            app()->route->redirect('/hello');
        }

        if ($roles === 'employee' && $role != 2) {
            app()->route->redirect('/hello');
        }
    }
}