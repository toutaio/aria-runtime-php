<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime;

/**
 * @template T
 * @template E
 */
abstract class Result
{
    /**
     * @template TValue
     *
     * @param TValue $value
     *
     * @return Success<TValue>
     */
    public static function success(mixed $value): Success
    {
        return Success::of($value);
    }

    /**
     * @template EValue
     *
     * @param EValue $error
     *
     * @return Failure<EValue>
     */
    public static function failure(mixed $error): Failure
    {
        return Failure::from($error);
    }

    abstract public function isSuccess(): bool;

    abstract public function isFailure(): bool;

    /**
     * @template U
     *
     * @param callable(T): U $fn
     *
     * @return Result<U, E>
     */
    abstract public function map(callable $fn): self;

    /**
     * @template U
     *
     * @param callable(T): Result<U, E> $fn
     *
     * @return Result<U, E>
     */
    abstract public function flatMap(callable $fn): self;

    /**
     * @template F
     *
     * @param callable(E): F $fn
     *
     * @return Result<T, F>
     */
    abstract public function mapFailure(callable $fn): self;

    /**
     * @template U
     *
     * @param callable(E): U $fn
     *
     * @return Result<T|U, E>
     */
    abstract public function recover(callable $fn): self;

    abstract public function getOrElse(mixed $default): mixed;
}
