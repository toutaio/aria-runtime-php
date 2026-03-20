<?php

declare(strict_types=1);

use Touta\Aria\Runtime\StructuredFailure;

it('creates a structured failure with code and message', function (): void {
    $failure = new StructuredFailure('NOT_FOUND', 'Resource not found');

    expect($failure)->toBeInstanceOf(StructuredFailure::class);
});

it('creates a structured failure with code, message, and context', function (): void {
    $failure = new StructuredFailure('VALIDATION', 'Invalid input', ['field' => 'email']);

    expect($failure)->toBeInstanceOf(StructuredFailure::class);
    expect($failure->context())->toBe(['field' => 'email']);
});

it('code returns the failure code string', function (): void {
    $failure = new StructuredFailure('NOT_FOUND', 'Resource not found');

    expect($failure->code())->toBe('NOT_FOUND');
});

it('message returns the failure message string', function (): void {
    $failure = new StructuredFailure('NOT_FOUND', 'Resource not found');

    expect($failure->message())->toBe('Resource not found');
});

it('context returns empty array when not provided', function (): void {
    $failure = new StructuredFailure('ERR', 'error');

    expect($failure->context())->toBe([]);
});

it('is immutable — withContext returns a different instance', function (): void {
    $original = new StructuredFailure('ERR', 'error', ['key' => 'value']);
    $modified = $original->withContext(['extra' => 'data']);

    expect($modified)->not->toBe($original);
    expect($original->context())->toBe(['key' => 'value']);
});

it('withMessage returns a new instance with updated message', function (): void {
    $original = new StructuredFailure('ERR', 'original message');
    $modified = $original->withMessage('updated message');

    expect($modified)->not->toBe($original);
    expect($modified->message())->toBe('updated message');
    expect($original->message())->toBe('original message');
});

it('withContext merges new context with existing', function (): void {
    $failure = new StructuredFailure('ERR', 'error', ['a' => 1]);
    $merged = $failure->withContext(['b' => 2]);

    expect($merged->context())->toBe(['a' => 1, 'b' => 2]);
});
