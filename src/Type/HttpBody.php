<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Type;

final readonly class HttpBody
{
    private function __construct(public string $value) {}

    public static function from(string $value): self
    {
        return new self($value);
    }
}
