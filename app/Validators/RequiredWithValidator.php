<?php

namespace Validators;

use Src\Validator\AbstractValidator;

//проверка обязательного поля
class RequiredWithValidator extends AbstractValidator {
    protected string $message = 'Поле :field обязательно при заполнении :other';

    public function rule(): bool {
        $otherField = $this->args[0];
        $otherValue = $this->data[$otherField] ?? null;
        return empty($otherValue) || !empty($this->value);
    }
}