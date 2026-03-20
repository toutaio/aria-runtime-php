<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Http;

interface RequestInterface
{
    public function method(): string;

    public function uri(): string;

    /**
     * @return array<string, list<string>>
     */
    public function headers(): array;

    public function body(): string;
}
