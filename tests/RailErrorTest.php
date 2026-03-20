<?php

declare(strict_types=1);

use Touta\Aria\Runtime\RailError;
use Touta\Aria\Runtime\StructuredFailure;

// Scenario: "can be constructed with all four fields"
it('can be constructed with all four fields', function (): void {
    $error = new StructuredFailure('ERR', 'something broke');
    $railError = new RailError(
        originAru: 'billing.invoice.create',
        traceId: 'trace-abc-123',
        timestamp: '2025-01-15T10:30:00+00:00',
        error: $error,
    );

    expect($railError)->toBeInstanceOf(RailError::class);
});

// Scenario: "exposes all fields as public readonly properties"
it('exposes all fields as public readonly properties', function (): void {
    $error = new StructuredFailure('VALIDATION', 'invalid input');
    $railError = new RailError(
        originAru: 'auth.login.validate',
        traceId: 'trace-def-456',
        timestamp: '2025-06-01T08:00:00+00:00',
        error: $error,
    );

    expect($railError->originAru)->toBe('auth.login.validate');
    expect($railError->traceId)->toBe('trace-def-456');
    expect($railError->timestamp)->toBe('2025-06-01T08:00:00+00:00');
    expect($railError->error)->toBe($error);
});

// Scenario: "preserves a StructuredFailure as the error type"
it('preserves a StructuredFailure as the error type', function (): void {
    $failure = new StructuredFailure('DOMAIN_ERR', 'domain error', ['key' => 'value']);
    $railError = new RailError(
        originAru: 'orders.place',
        traceId: 'trace-ghi-789',
        timestamp: '2025-03-10T12:00:00+00:00',
        error: $failure,
    );

    expect($railError->error)->toBeInstanceOf(StructuredFailure::class);
    expect($railError->error->code())->toBe('DOMAIN_ERR');
    expect($railError->error->message())->toBe('domain error');
    expect($railError->error->context())->toBe(['key' => 'value']);
});

// Scenario: "preserves a plain string as the error type"
it('preserves a plain string as the error type', function (): void {
    $railError = new RailError(
        originAru: 'notifications.send',
        traceId: 'trace-jkl-012',
        timestamp: '2025-07-20T16:45:00+00:00',
        error: 'simple string error',
    );

    expect($railError->error)->toBe('simple string error');
    expect($railError->error)->toBeString();
});

// Scenario: "holds an ISO 8601 timestamp"
it('holds an ISO 8601 timestamp', function (): void {
    $railError = new RailError(
        originAru: 'metrics.collect',
        traceId: 'trace-mno-345',
        timestamp: '2025-12-25T00:00:00+00:00',
        error: 'test',
    );

    $parsed = DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, $railError->timestamp);

    expect($parsed)->toBeInstanceOf(DateTimeImmutable::class);
    expect($parsed->format(DateTimeInterface::ATOM))->toBe('2025-12-25T00:00:00+00:00');
});
