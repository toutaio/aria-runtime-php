<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime;

/**
 * @template E
 *
 * @extends Result<never, E>
 */
final class Failure extends Result
{
    /**
     * @param E $error
     */
    private function __construct(
        private readonly mixed $error,
    ) {}

    /**
     * @template EValue
     *
     * @param EValue $error
     *
     * @return self<EValue>
     */
    public static function from(mixed $error): self
    {
        return new self($error);
    }

    /**
     * @return E
     */
    public function error(): mixed
    {
        return $this->error;
    }

    public function isSuccess(): bool
    {
        return false;
    }

    public function isFailure(): bool
    {
        return true;
    }

    /**
     * @param callable(never): mixed $fn
     *
     * @return self<E>
     */
    public function map(callable $fn): Result
    {
        return $this;
    }

    /**
     * @param callable(never): Result<never, E> $fn
     *
     * @return self<E>
     */
    public function flatMap(callable $fn): Result
    {
        return $this;
    }

    /**
     * @template F
     *
     * @param callable(E): F $fn
     *
     * @return Failure<F>
     */
    public function mapFailure(callable $fn): Result
    {
        return new self($fn($this->error));
    }

    /**
     * @template U
     *
     * @param callable(E): U $fn
     *
     * @return Success<U>
     */
    public function recover(callable $fn): Result
    {
        return Success::of($fn($this->error));
    }

    public function getOrElse(mixed $default): mixed
    {
        return $default;
    }
}
