<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime;

final class StructuredFailure
{
    /**
     * @param array<string, mixed> $context
     */
    public function __construct(
        private readonly string $code,
        private readonly string $message,
        private readonly array $context = [],
    ) {}

    public function code(): string
    {
        return $this->code;
    }

    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return $this->context;
    }

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
