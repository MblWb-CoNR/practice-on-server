<?php

namespace Controller;

use Model\User;
use Src\Request;
use Src\View;
use Src\Auth\Auth;

class ApiAuthController
{
    public function login(Request $request): void
    {
        $credentials = $request->all();

        // Проверяем наличие обязательных полей
        if (empty($credentials['login']) || empty($credentials['password'])) {
            (new View())->toJSON(['error' => 'Login and password are required'], 400);
            return;
        }

        // Ищем пользователя
        $user = User::where('login', $credentials['login'])->first();

        // Проверяем пароль
        if (!$user || md5($credentials['password']) !== $user->password) {
            (new View())->toJSON(['error' => 'Invalid credentials'], 401);
            return;
        }

        // Генерируем токен
        $token = $user->generateToken();

        (new View())->toJSON([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name
            ]
        ]);
    }

    public function logout(Request $request): void
    {
        $authHeader = $request->headers['Authorization'] ?? '';
        $token = str_replace('Bearer ', '', $authHeader);

        $user = User::where('token', $token)->first();

        if ($user) {
            $user->removeToken();
            (new View())->toJSON(['message' => 'Logged out successfully']);
            return;
        }

        (new View())->toJSON(['error' => 'User not found'], 404);
    }
}