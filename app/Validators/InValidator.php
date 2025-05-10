<?php

namespace Validators;

use Src\Validator\AbstractValidator;

//проверка значения из списка
class InValidator extends AbstractValidator {
    protected string $message = 'Поле :field содержит недопустимое значение';

    public function rule(): bool {
        return in_array($this->value, $this->args);
    }
}