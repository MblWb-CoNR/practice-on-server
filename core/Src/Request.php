<?php

namespace Src;

use Error;

class Request
{
    protected array $body;
    public string $method;
    public array $headers;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->headers = getallheaders() ?? [];

        // Чтение JSON данных для POST/PUT/PATCH
        if (in_array($this->method, ['POST', 'PUT', 'PATCH'])) {
            $input = json_decode(file_get_contents('php://input'), true) ?? [];
            $this->body = array_merge($_GET, $_POST, $input);
        } else {
            $this->body = $_GET;
        }
    }

    public function all(): array
    {
        return $this->body;
    }

    public function set($field, $value):void
    {
        $this->body[$field] = $value;
    }

    public function get(string $key, $default = null)
    {
        // Добавляем проверку существования ключа
        return $this->body[$key] ?? $default;
    }

    public function files(): array
    {
        return $_FILES;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->body)) {
            return $this->body[$key];
        }
        throw new Error('Accessing a non-existent property');
    }

    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }
}
