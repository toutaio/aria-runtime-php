<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime;

/**
 * @template T
 *
 * @extends Result<T, never>
 */
final class Success extends Result
{
    /**
     * @param T $value
     */
    private function __construct(
        private readonly mixed $value,
    ) {}

    /**
     * @template TValue
     *
     * @param TValue $value
     *
     * @return self<TValue>
     */
    public static function of(mixed $value): self
    {
        return new self($value);
    }

    /**
     * @return T
     */
    public function value(): mixed
    {
        return $this->value;
    }

    public function isSuccess(): bool
    {
        return true;
    }

    public function isFailure(): bool
    {
        return false;
    }

    /**
     * @template U
     *
     * @param callable(T): U $fn
     *
     * @return Success<U>
     */
    public function map(callable $fn): Result
    {
        return new self($fn($this->value));
    }

    /**
     * @template U
     *
     * @param callable(T): Result<U, never> $fn
     *
     * @return Result<U, never>
     */
    public function flatMap(callable $fn): Result
    {
        return $fn($this->value);
    }

    /**
     * @param callable(never): mixed $fn
     *
     * @return self<T>
     */
    public function mapFailure(callable $fn): Result
    {
        return $this;
    }

    /**
     * @param callable(never): mixed $fn
     *
     * @return self<T>
     */
    public function recover(callable $fn): Result
    {
        return $this;
    }

    /**
     * @return T
     */
    public function getOrElse(mixed $default): mixed
    {
        return $this->value;
    }
}
