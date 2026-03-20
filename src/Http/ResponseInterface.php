<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Http;

use Touta\Aria\Runtime\Type\HeaderMap;
use Touta\Aria\Runtime\Type\HttpBody;
use Touta\Aria\Runtime\Type\StatusCode;

interface ResponseInterface
{
    public function statusCode(): StatusCode;

    public function headers(): HeaderMap;

    public function body(): HttpBody;
}
