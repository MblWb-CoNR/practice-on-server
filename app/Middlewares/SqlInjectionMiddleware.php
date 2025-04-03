<?php

namespace Middlewares;

use Exception;
use Src\Request;
use Src\Session;

class SqlInjectionMiddleware {
    public function handle(Request $request): Request {
        foreach ($request->all() as $key => $value) {
            if (is_string($value)) {
                $request->set($key, preg_replace('/[\x00-\x1F\x7F]/', '', $value));
            }
        }
        return $request;
    }
}