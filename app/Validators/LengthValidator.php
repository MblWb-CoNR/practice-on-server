<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class LengthValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть от :min до :max символов';

    public function rule(): bool
    {
        $min = $this->args[0] ?? 0;
        $max = $this->args[1] ?? PHP_INT_MAX;

        $length = mb_strlen($this->value);
        return $length >= $min && $length <= $max;
    }
}