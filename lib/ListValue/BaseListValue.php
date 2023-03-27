<?php

declare(strict_types=1);

namespace Lib\ListValue;

use Limit;
use Offset;

/**
 * @template T
 */
abstract class BaseListValue implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var T[] $array
     */
    protected array $array;

    /**
     * @param T[] $array
     */
    public function __construct(array $array)
    {
        // keyが連番の数字になることを強制する
        $this->array = array_values($array);
    }

    public static function makeEmpty()
    {
        return new static([]);
    }

    public function count(): int
    {
        return count($this->array);
    }

    /* IteratorAggregateインターフェースの実装 */

    /**
     * @param int $offset
     * @return T
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->offsetExists($offset) ? $this->array[$offset] : null;
    }

    /* ArrayAccessインターフェースの実装 */

    /**
     * @param int $offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->array[$offset]);
    }

    /**
     * @param int $offset
     * @param T $value
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    /**
     * @param int $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->array[$offset]);
    }

    public function isEmpty(): bool
    {
        return count($this->array) === 0;
    }

    /**
     * @template X
     * @param callable(T): X $closure
     * @return X[]
     */
    public function map(callable $closure): array
    {
        $result = [];
        $iterator = $this->getIterator();
        foreach ($iterator as $item) {
            $result[] = $closure($item);
        }
        return $result;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->array);
    }

    /**
     * @param callable(T): void $closure
     */
    public function forEach(callable $closure): void
    {
        $iterator = $this->getIterator();
        foreach ($iterator as $item) {
            $closure($item);
        }
    }

    public function reverse(): self
    {
        return new static(array_reverse($this->array));
    }

    /**
     * @param callable(T): bool $closure
     * @return T[]
     */
    public function filter(callable $closure): array
    {
        return array_values(array_filter($this->array, $closure));
    }

    public function limit(int $limit): self
    {
        return new static(array_slice($this->array, 0, $limit));
    }

    public function slice(Offset $offset, ?Limit $limit = null)
    {
        $rawLimit = is_null($limit) ? null : $limit->rawValue();
        return new static(array_slice($this->array, $offset->rawValue(), $rawLimit));
    }

    public function chunk(int $length): array
    {
        return array_chunk($this->array, $length);
    }

    /**
     * @param callable(T): bool $closure
     */
    public function some(callable $closure): bool
    {
        return array_reduce($this->array, function ($carry, $item) use ($closure) {
            return $carry || $closure($item);
        }, false);
    }

    /**
     * @param callable(T): bool $closure
     */
    public function every(callable $closure): bool
    {
        return array_reduce($this->array, function ($carry, $item) use ($closure) {
            return $carry && $closure($item);
        }, true);
    }

    /**
     * @template X
     * @param callable(X, T): X $closure
     * @param X|null $initial
     * @return X
     */
    public function reduce(callable $closure, mixed $initial)
    {
        return array_reduce($this->array, $closure, $initial);
    }

    public function merge(self $add): self
    {
        return new static(array_merge($this->array, $add->array));
    }

    public function toArray(): array
    {
        return $this->array;
    }
}
