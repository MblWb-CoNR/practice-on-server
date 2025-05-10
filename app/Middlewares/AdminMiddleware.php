<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request, ?string $role = null): void
    {
        // Если пользователь не авторизован - отправляем на страницу входа
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        // Проверяем, что пользователь имеет роль администратора (role_id = 1)
        if (Auth::user()->role_id != 1) {
            app()->route->redirect('/');
        }
    }
}