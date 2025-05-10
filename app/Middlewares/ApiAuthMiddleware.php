<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class ApiAuthMiddleware
{
    public function handle(Request $request): Request
    {
        // Для маршрута login пропускаем проверку
        if (strpos($request->getUri(), '/api/login') !== false) {
            return $request;
        }

        $authHeader = $request->headers['Authorization'] ?? null;

        if (!$authHeader) {
            (new View())->toJSON(['error' => 'Authorization header is missing'], 401);
            exit;
        }

        if (!str_starts_with($authHeader, 'Bearer ')) {
            (new View())->toJSON(['error' => 'Invalid Authorization header format'], 401);
            exit;
        }

        $token = substr($authHeader, 7);

        if (!Auth::attempt(['token' => $token])) {
            (new View())->toJSON(['error' => 'Invalid or expired token'], 401);
            exit;
        }

        return $request;
    }
}