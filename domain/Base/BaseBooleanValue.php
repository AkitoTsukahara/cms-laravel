<?php

declare(strict_types=1);

namespace Domain\Base;

abstract class BaseBooleanValue
{
    const YES = true;
    const NO = false;

    private $bool;

    public function __construct(bool $bool)
    {
        $this->bool = $bool;
    }

    public function isYes(): bool
    {
        return $this->bool;
    }

    public function isNo(): bool
    {
        return !$this->isYes();
    }

    public function rawValue(): bool
    {
        return $this->bool;
    }

    public function displayName(): string
    {
        return $this->bool ? 'はい' : 'いいえ';
    }

    final public function __toString()
    {
        return $this->displayName();
    }

    public static function createYes()
    {
        return new static(static::YES);
    }

    public static function createNo()
    {
        return new static(static::NO);
    }
}
