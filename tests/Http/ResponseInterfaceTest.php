<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Http\ResponseInterface;

it('interface exists', function (): void {
    expect(interface_exists(ResponseInterface::class))->toBeTrue();
});

it('declares statusCode() returning int', function (): void {
    $reflection = new ReflectionClass(ResponseInterface::class);
    $method = $reflection->getMethod('statusCode');

    expect($method->getReturnType()?->getName())->toBe('int');
});

it('declares headers() returning array', function (): void {
    $reflection = new ReflectionClass(ResponseInterface::class);
    $method = $reflection->getMethod('headers');

    expect($method->getReturnType()?->getName())->toBe('array');
});

it('declares body() returning string', function (): void {
    $reflection = new ReflectionClass(ResponseInterface::class);
    $method = $reflection->getMethod('body');

    expect($method->getReturnType()?->getName())->toBe('string');
});
