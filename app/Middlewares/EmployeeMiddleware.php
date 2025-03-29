<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class EmployeeMiddleware
{
    public function handle(Request $request, ?string $role = null): void
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        // Проверяем, что пользователь имеет роль сотрудника (role_id = 2)
        if (Auth::user()->role_id != 2) {
            app()->route->redirect('/');
        }
    }
}