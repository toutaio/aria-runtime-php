<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Http\ResponseInterface;
use Touta\Aria\Runtime\Type\HeaderMap;
use Touta\Aria\Runtime\Type\HttpBody;
use Touta\Aria\Runtime\Type\StatusCode;

// Scenario: "interface exists"
it('interface exists', function (): void {
    expect(interface_exists(ResponseInterface::class))->toBeTrue();
});

// Scenario: "declares statusCode() returning StatusCode"
it('declares statusCode() returning StatusCode', function (): void {
    $reflection = new ReflectionClass(ResponseInterface::class);
    $method = $reflection->getMethod('statusCode');

    expect($method->getReturnType()?->getName())->toBe(StatusCode::class);
});

// Scenario: "declares headers() returning HeaderMap"
it('declares headers() returning HeaderMap', function (): void {
    $reflection = new ReflectionClass(ResponseInterface::class);
    $method = $reflection->getMethod('headers');

    expect($method->getReturnType()?->getName())->toBe(HeaderMap::class);
});

// Scenario: "declares body() returning HttpBody"
it('declares body() returning HttpBody', function (): void {
    $reflection = new ReflectionClass(ResponseInterface::class);
    $method = $reflection->getMethod('body');

    expect($method->getReturnType()?->getName())->toBe(HttpBody::class);
});
