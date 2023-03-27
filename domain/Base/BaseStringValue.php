<?php

declare(strict_types=1);

namespace Domain\Base;

abstract class BaseStringValue extends BaseValue
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function makeDummy()
    {
        return new static('ダミーテキストです');
    }

    public function rawValue(): string
    {
        return $this->value;
    }

    public function equals(BaseStringValue $another): bool
    {
        return $this->value === $another->rawValue();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
