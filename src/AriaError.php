<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime;

/**
 * Domain-typed error for the ARIA runtime package.
 *
 * Replaces generic StructuredFailure in aria-runtime-php's own contracts.
 * Other packages define their own domain error types (ConfigError, RoutingError, etc.).
 */
final readonly class AriaError
{
    public const TYPE_MISMATCH = 'ARIA.TYPE_MISMATCH';
    public const INVALID_RESULT = 'ARIA.INVALID_RESULT';
    public const INVALID_ADDRESS = 'ARIA.INVALID_ADDRESS';
    public const LAYER_VIOLATION = 'ARIA.LAYER_VIOLATION';

    /**
     * @param array<string, mixed> $context
     */
    public function __construct(
        public string $code,
        public string $message,
        public array $context = [],
    ) {}

    public function withMessage(string $message): self
    {
        return new self($this->code, $message, $this->context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function withContext(array $context): self
    {
        return new self($this->code, $this->message, array_merge($this->context, $context));
    }
}
