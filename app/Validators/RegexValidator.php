<?php

namespace Validators;

use Src\Validator\AbstractValidator;

//проверка по регулярке
class RegexValidator extends AbstractValidator {
    protected string $message = 'Поле :field содержит недопустимые символы';

    public function rule(): bool {
        return (bool)preg_match($this->args[0], $this->value);
    }
}