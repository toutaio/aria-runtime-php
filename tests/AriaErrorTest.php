<?php

declare(strict_types=1);

use Touta\Aria\Runtime\AriaError;

// Scenario: "can be constructed with code, message, and context"
it('can be constructed with code, message, and context', function (): void {
    $error = new AriaError(
        code: AriaError::TYPE_MISMATCH,
        message: 'Expected int, got string',
        context: ['expected' => 'int', 'actual' => 'string'],
    );

    expect($error)->toBeInstanceOf(AriaError::class);
    expect($error->code)->toBe('ARIA.TYPE_MISMATCH');
    expect($error->message)->toBe('Expected int, got string');
    expect($error->context)->toBe(['expected' => 'int', 'actual' => 'string']);
});

// Scenario: "has correct code constants"
it('has correct code constants', function (): void {
    expect(AriaError::TYPE_MISMATCH)->toBe('ARIA.TYPE_MISMATCH');
    expect(AriaError::INVALID_RESULT)->toBe('ARIA.INVALID_RESULT');
    expect(AriaError::INVALID_ADDRESS)->toBe('ARIA.INVALID_ADDRESS');
    expect(AriaError::LAYER_VIOLATION)->toBe('ARIA.LAYER_VIOLATION');
});

// Scenario: "withMessage returns a new instance with updated message"
it('withMessage returns a new instance with updated message', function (): void {
    $original = new AriaError(
        code: AriaError::INVALID_RESULT,
        message: 'original message',
        context: ['foo' => 'bar'],
    );

    $updated = $original->withMessage('new message');

    expect($updated)->not->toBe($original);
    expect($updated->message)->toBe('new message');
    expect($updated->code)->toBe(AriaError::INVALID_RESULT);
    expect($updated->context)->toBe(['foo' => 'bar']);
});

// Scenario: "withContext merges new context with existing context"
it('withContext merges new context with existing context', function (): void {
    $original = new AriaError(
        code: AriaError::LAYER_VIOLATION,
        message: 'layer error',
        context: ['layer' => 'application'],
    );

    $updated = $original->withContext(['detail' => 'crossed boundary']);

    expect($updated)->not->toBe($original);
    expect($updated->context)->toBe(['layer' => 'application', 'detail' => 'crossed boundary']);
    expect($updated->code)->toBe(AriaError::LAYER_VIOLATION);
    expect($updated->message)->toBe('layer error');
});

// Scenario: "context defaults to empty array"
it('context defaults to empty array', function (): void {
    $error = new AriaError(
        code: AriaError::INVALID_ADDRESS,
        message: 'bad address',
    );

    expect($error->context)->toBe([]);
});
