<?php

declare(strict_types=1);

namespace Touta\Aria\Runtime;

/**
 * Provenance wrapper for errors on the failure rail in composed flows.
 *
 * Individual ARUs return Result<T, DomainError>. Composition layers
 * (PIPE chains, middleware pipelines) wrap errors in RailError before
 * placing them on the failure rail to preserve origin traceability.
 *
 * @template E
 */
final readonly class RailError
{
    /**
     * @param string $originAru  Semantic address of the ARU that produced the error
     * @param string $traceId    Correlation ID for observability
     * @param string $timestamp  ISO 8601 timestamp of when the error occurred
     * @param E      $error      The domain-typed error
     */
    public function __construct(
        public string $originAru,
        public string $traceId,
        public string $timestamp,
        public mixed $error,
    ) {}
}
