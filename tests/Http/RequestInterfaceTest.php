<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Http\RequestInterface;
use Touta\Aria\Runtime\Type\HeaderMap;
use Touta\Aria\Runtime\Type\HttpBody;
use Touta\Aria\Runtime\Type\HttpMethod;
use Touta\Aria\Runtime\Type\UriPath;

// Scenario: "interface exists"
it('interface exists', function (): void {
    expect(interface_exists(RequestInterface::class))->toBeTrue();
});

// Scenario: "declares method() returning HttpMethod"
it('declares method() returning HttpMethod', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('method');

    expect($method->getReturnType()?->getName())->toBe(HttpMethod::class);
});

// Scenario: "declares uri() returning UriPath"
it('declares uri() returning UriPath', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('uri');

    expect($method->getReturnType()?->getName())->toBe(UriPath::class);
});

// Scenario: "declares headers() returning HeaderMap"
it('declares headers() returning HeaderMap', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('headers');

    expect($method->getReturnType()?->getName())->toBe(HeaderMap::class);
});

// Scenario: "declares body() returning HttpBody"
it('declares body() returning HttpBody', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('body');

    expect($method->getReturnType()?->getName())->toBe(HttpBody::class);
});
