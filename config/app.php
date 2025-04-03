<?php

return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'admin' => \Middlewares\AdminMiddleware::class,
        'employee' => \Middlewares\EmployeeMiddleware::class,
    ],
    //Классы middleware для валидации, фильтрации
    'routeAppMiddleware' => [
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'sqlInjection' => \Middlewares\SqlInjectionMiddleware::class
    ],
    //Классы для валидации
    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'exists' => \Validators\ExistsValidator::class,
        'regex' => \Validators\RegexValidator::class,
        'in' => \Validators\InValidator::class,
        'required_with' => \Validators\RequiredWithValidator::class,
        'min' => \Validators\LengthValidator::class,
    ],
];