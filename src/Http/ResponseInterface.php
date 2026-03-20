<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Http;

interface ResponseInterface
{
    public function statusCode(): int;

    /**
     * @return array<string, list<string>>
     */
    public function headers(): array;

    public function body(): string;
}
