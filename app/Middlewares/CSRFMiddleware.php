<?php

namespace Middlewares;

use Src\Request;
use Src\Session;

class CSRFMiddleware
{
    public function handle(Request $request): void
    {

        // Пропускаем GET, OPTIONS, HEAD запросы
        if (!in_array($request->method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return;
        }

        // Получаем токены
        $sessionToken = Session::get('csrf_token');
        $requestToken = $request->get('csrf_token');

        // Проверяем токены
        if (empty($sessionToken) || empty($requestToken)) {
            throw new \RuntimeException('CSRF token missing');
        }

        if (!hash_equals($sessionToken, $requestToken)) {
            throw new \RuntimeException('CSRF token mismatch');
        }
    }
}