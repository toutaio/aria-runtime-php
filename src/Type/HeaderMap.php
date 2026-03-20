<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Type;

final readonly class HeaderMap
{
    /** @param array<string, list<string>> $value */
    private function __construct(public array $value) {}

    /** @param array<string, list<string>> $value */
    public static function from(array $value): self
    {
        return new self($value);
    }
}
