<?php

namespace Validators;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Validator\AbstractValidator;

//проверяет существование записи в БД
class ExistsValidator extends AbstractValidator {
    protected string $message = 'Такого для :field не существует';

    public function rule(): bool {
        return (bool)Capsule::table($this->args[0])
            ->where('id', $this->value)
            ->count();
    }
}