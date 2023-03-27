<?php

declare(strict_types=1);

namespace Domain\Base;

use Domain\Exception\InvalidArgumentException;

abstract class BaseNonNegativeIntValue extends BaseIntValue
{
    public function __construct($value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException();
        }

        parent::__construct($value);
    }

    public static function makeZero()
    {
        return new static(0);
    }
}
