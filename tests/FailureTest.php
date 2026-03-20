<?php

declare(strict_types=1);

use Touta\Aria\Runtime\StructuredFailure;

// Scenario: "creates a structured failure with code and message"
it('creates a structured failure with code and message', function (): void {
    $failure = new StructuredFailure('NOT_FOUND', 'Resource not found');

    expect($failure)->toBeInstanceOf(StructuredFailure::class);
});

// Scenario: "creates a structured failure with code, message, and context"
it('creates a structured failure with code, message, and context', function (): void {
    $failure = new StructuredFailure('VALIDATION', 'Invalid input', ['field' => 'email']);

    expect($failure)->toBeInstanceOf(StructuredFailure::class);
    expect($failure->context())->toBe(['field' => 'email']);
});

// Scenario: "code returns the failure code string"
it('code returns the failure code string', function (): void {
    $failure = new StructuredFailure('NOT_FOUND', 'Resource not found');

    expect($failure->code())->toBe('NOT_FOUND');
});

// Scenario: "message returns the failure message string"
it('message returns the failure message string', function (): void {
    $failure = new StructuredFailure('NOT_FOUND', 'Resource not found');

    expect($failure->message())->toBe('Resource not found');
});

// Scenario: "context returns empty array when not provided"
it('context returns empty array when not provided', function (): void {
    $failure = new StructuredFailure('ERR', 'error');

    expect($failure->context())->toBe([]);
});

// Scenario: "is immutable — withContext returns a different instance"
it('is immutable — withContext returns a different instance', function (): void {
    $original = new StructuredFailure('ERR', 'error', ['key' => 'value']);
    $modified = $original->withContext(['extra' => 'data']);

    expect($modified)->not->toBe($original);
    expect($original->context())->toBe(['key' => 'value']);
});

// Scenario: "withMessage returns a new instance with updated message"
it('withMessage returns a new instance with updated message', function (): void {
    $original = new StructuredFailure('ERR', 'original message');
    $modified = $original->withMessage('updated message');

    expect($modified)->not->toBe($original);
    expect($modified->message())->toBe('updated message');
    expect($original->message())->toBe('original message');
});

// Scenario: "withContext merges new context with existing"
it('withContext merges new context with existing', function (): void {
    $failure = new StructuredFailure('ERR', 'error', ['a' => 1]);
    $merged = $failure->withContext(['b' => 2]);

    expect($merged->context())->toBe(['a' => 1, 'b' => 2]);
});
