<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Type;

final readonly class StatusCode
{
    private function __construct(public int $value) {}

    public static function from(int $value): self
    {
        return new self($value);
    }
}
