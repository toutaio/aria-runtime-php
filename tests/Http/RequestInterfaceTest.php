<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Http\RequestInterface;

it('interface exists', function (): void {
    expect(interface_exists(RequestInterface::class))->toBeTrue();
});

it('declares method() returning string', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('method');

    expect($method->getReturnType()?->getName())->toBe('string');
});

it('declares uri() returning string', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('uri');

    expect($method->getReturnType()?->getName())->toBe('string');
});

it('declares headers() returning array', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('headers');

    expect($method->getReturnType()?->getName())->toBe('array');
});

it('declares body() returning string', function (): void {
    $reflection = new ReflectionClass(RequestInterface::class);
    $method = $reflection->getMethod('body');

    expect($method->getReturnType()?->getName())->toBe('string');
});
