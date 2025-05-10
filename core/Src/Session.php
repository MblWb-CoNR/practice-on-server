<?php

namespace Src;

class Session
{
    public static function init(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, $value): void
    {
        self::init();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null)
    {
        self::init();
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        self::init();
        return isset($_SESSION[$key]);
    }
}