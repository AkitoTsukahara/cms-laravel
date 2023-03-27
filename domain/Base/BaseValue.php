<?php

declare(strict_types=1);

namespace Domain\Base;

abstract class BaseValue
{
    protected $value;

    public function hasValue(): bool
    {
        return !$this instanceof Undefined;
    }
}
