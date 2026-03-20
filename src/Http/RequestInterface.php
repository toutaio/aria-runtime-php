<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime\Http;

use Touta\Aria\Runtime\Type\HeaderMap;
use Touta\Aria\Runtime\Type\HttpBody;
use Touta\Aria\Runtime\Type\HttpMethod;
use Touta\Aria\Runtime\Type\UriPath;

interface RequestInterface
{
    public function method(): HttpMethod;

    public function uri(): UriPath;

    public function headers(): HeaderMap;

    public function body(): HttpBody;
}
