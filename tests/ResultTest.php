<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Failure;
use Touta\Aria\Runtime\Result;
use Touta\Aria\Runtime\StructuredFailure;
use Touta\Aria\Runtime\Success;

it('creates a success result via Success::of()', function (): void {
    $result = Success::of(42);

    expect($result)->toBeInstanceOf(Success::class);
    expect($result)->toBeInstanceOf(Result::class);
});

it('success is a success', function (): void {
    $result = Success::of('hello');

    expect($result->isSuccess())->toBeTrue();
    expect($result->isFailure())->toBeFalse();
});

it('success value returns the wrapped value', function (): void {
    $result = Success::of(42);

    expect($result->value())->toBe(42);
});

it('creates a failure result via Failure::from()', function (): void {
    $error = new StructuredFailure('ERR', 'something went wrong');
    $result = Failure::from($error);

    expect($result)->toBeInstanceOf(Failure::class);
    expect($result)->toBeInstanceOf(Result::class);
});

it('failure is a failure', function (): void {
    $error = new StructuredFailure('ERR', 'something went wrong');
    $result = Failure::from($error);

    expect($result->isFailure())->toBeTrue();
    expect($result->isSuccess())->toBeFalse();
});

it('failure error returns the wrapped error', function (): void {
    $error = new StructuredFailure('ERR', 'something went wrong');
    $result = Failure::from($error);

    expect($result->error())->toBe($error);
});

it('map on success transforms the value', function (): void {
    $result = Success::of(10);
    $mapped = $result->map(fn(int $v): int => $v * 3);

    expect($mapped)->toBeInstanceOf(Success::class);
    expect($mapped->value())->toBe(30);
});

it('map on failure passes through unchanged', function (): void {
    $error = new StructuredFailure('ERR', 'fail');
    $result = Failure::from($error);
    $mapped = $result->map(fn(mixed $v): string => 'should not run');

    expect($mapped)->toBeInstanceOf(Failure::class);
    expect($mapped->error())->toBe($error);
});

it('flatMap on success chains to the next result', function (): void {
    $result = Success::of(5);
    $chained = $result->flatMap(fn(int $v): Result => Success::of($v + 10));

    expect($chained)->toBeInstanceOf(Success::class);
    expect($chained->value())->toBe(15);
});

it('flatMap on failure passes through unchanged', function (): void {
    $error = new StructuredFailure('ERR', 'fail');
    $result = Failure::from($error);
    $chained = $result->flatMap(fn(mixed $v): Result => Success::of('nope'));

    expect($chained)->toBeInstanceOf(Failure::class);
    expect($chained->error())->toBe($error);
});

it('mapFailure on failure transforms the error', function (): void {
    $error = new StructuredFailure('ERR', 'original');
    $result = Failure::from($error);
    $mapped = $result->mapFailure(fn(StructuredFailure $e): StructuredFailure => $e->withMessage('transformed'));

    expect($mapped)->toBeInstanceOf(Failure::class);
    expect($mapped->error()->message())->toBe('transformed');
});

it('mapFailure on success passes through unchanged', function (): void {
    $result = Success::of(42);
    $mapped = $result->mapFailure(fn(mixed $e): mixed => throw new RuntimeException('should not run'));

    expect($mapped)->toBeInstanceOf(Success::class);
    expect($mapped->value())->toBe(42);
});

it('recover on failure converts to success', function (): void {
    $error = new StructuredFailure('ERR', 'fail');
    $result = Failure::from($error);
    $recovered = $result->recover(fn(StructuredFailure $e): string => 'recovered');

    expect($recovered)->toBeInstanceOf(Success::class);
    expect($recovered->value())->toBe('recovered');
});

it('recover on success passes through unchanged', function (): void {
    $result = Success::of(42);
    $recovered = $result->recover(fn(mixed $e): string => 'should not run');

    expect($recovered)->toBeInstanceOf(Success::class);
    expect($recovered->value())->toBe(42);
});

it('getOrElse on success returns the value', function (): void {
    $result = Success::of(42);

    expect($result->getOrElse(0))->toBe(42);
});

it('getOrElse on failure returns the default', function (): void {
    $error = new StructuredFailure('ERR', 'fail');
    $result = Failure::from($error);

    expect($result->getOrElse(99))->toBe(99);
});
