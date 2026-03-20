<?php

declare(strict_types=1);

use Touta\Aria\Runtime\Type\HeaderMap;
use Touta\Aria\Runtime\Type\HttpBody;
use Touta\Aria\Runtime\Type\HttpMethod;
use Touta\Aria\Runtime\Type\SemanticAddress;
use Touta\Aria\Runtime\Type\StatusCode;
use Touta\Aria\Runtime\Type\TraceId;
use Touta\Aria\Runtime\Type\UriPath;

// HttpMethod

// Scenario: "creates HttpMethod via from()"
it('creates HttpMethod via from()', function (): void {
    $method = HttpMethod::from('GET');

    expect($method->value)->toBe('GET');
});

// Scenario: "HttpMethod equal instances are equal"
it('HttpMethod equal instances are equal', function (): void {
    expect(HttpMethod::from('POST') == HttpMethod::from('POST'))->toBeTrue();
});

// Scenario: "HttpMethod different instances are not equal"
it('HttpMethod different instances are not equal', function (): void {
    expect(HttpMethod::from('GET') == HttpMethod::from('DELETE'))->toBeFalse();
});

// UriPath

// Scenario: "creates UriPath via from()"
it('creates UriPath via from()', function (): void {
    $path = UriPath::from('/api/users');

    expect($path->value)->toBe('/api/users');
});

// Scenario: "UriPath equal instances are equal"
it('UriPath equal instances are equal', function (): void {
    expect(UriPath::from('/foo') == UriPath::from('/foo'))->toBeTrue();
});

// Scenario: "UriPath different instances are not equal"
it('UriPath different instances are not equal', function (): void {
    expect(UriPath::from('/foo') == UriPath::from('/bar'))->toBeFalse();
});

// HeaderMap

// Scenario: "creates HeaderMap via from()"
it('creates HeaderMap via from()', function (): void {
    $headers = HeaderMap::from(['Content-Type' => ['application/json']]);

    expect($headers->value)->toBe(['Content-Type' => ['application/json']]);
});

// Scenario: "HeaderMap equal instances are equal"
it('HeaderMap equal instances are equal', function (): void {
    $h = ['X-Key' => ['val']];

    expect(HeaderMap::from($h) == HeaderMap::from($h))->toBeTrue();
});

// Scenario: "HeaderMap different instances are not equal"
it('HeaderMap different instances are not equal', function (): void {
    expect(
        HeaderMap::from(['A' => ['1']]) == HeaderMap::from(['B' => ['2']]),
    )->toBeFalse();
});

// HttpBody

// Scenario: "creates HttpBody via from()"
it('creates HttpBody via from()', function (): void {
    $body = HttpBody::from('{"ok":true}');

    expect($body->value)->toBe('{"ok":true}');
});

// Scenario: "HttpBody equal instances are equal"
it('HttpBody equal instances are equal', function (): void {
    expect(HttpBody::from('x') == HttpBody::from('x'))->toBeTrue();
});

// Scenario: "HttpBody different instances are not equal"
it('HttpBody different instances are not equal', function (): void {
    expect(HttpBody::from('a') == HttpBody::from('b'))->toBeFalse();
});

// StatusCode

// Scenario: "creates StatusCode via from()"
it('creates StatusCode via from()', function (): void {
    $code = StatusCode::from(200);

    expect($code->value)->toBe(200);
});

// Scenario: "StatusCode equal instances are equal"
it('StatusCode equal instances are equal', function (): void {
    expect(StatusCode::from(404) == StatusCode::from(404))->toBeTrue();
});

// Scenario: "StatusCode different instances are not equal"
it('StatusCode different instances are not equal', function (): void {
    expect(StatusCode::from(200) == StatusCode::from(500))->toBeFalse();
});

// SemanticAddress

// Scenario: "creates SemanticAddress via from()"
it('creates SemanticAddress via from()', function (): void {
    $addr = SemanticAddress::from('aria.result.Success');

    expect($addr->value)->toBe('aria.result.Success');
});

// Scenario: "SemanticAddress equal instances are equal"
it('SemanticAddress equal instances are equal', function (): void {
    expect(
        SemanticAddress::from('aria.result.Success') == SemanticAddress::from('aria.result.Success'),
    )->toBeTrue();
});

// Scenario: "SemanticAddress different instances are not equal"
it('SemanticAddress different instances are not equal', function (): void {
    expect(
        SemanticAddress::from('aria.result.Success') == SemanticAddress::from('aria.result.Failure'),
    )->toBeFalse();
});

// TraceId

// Scenario: "creates TraceId via from()"
it('creates TraceId via from()', function (): void {
    $id = TraceId::from('abc-123');

    expect($id->value)->toBe('abc-123');
});

// Scenario: "TraceId equal instances are equal"
it('TraceId equal instances are equal', function (): void {
    expect(TraceId::from('x-1') == TraceId::from('x-1'))->toBeTrue();
});

// Scenario: "TraceId different instances are not equal"
it('TraceId different instances are not equal', function (): void {
    expect(TraceId::from('x-1') == TraceId::from('x-2'))->toBeFalse();
});
