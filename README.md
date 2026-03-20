# aria-runtime-php

ARIA runtime primitives for the Touta PHP ecosystem.

## Install

```bash
composer require touta/aria-runtime-php
```

## What's included

- **Result** — Railway-oriented `Result` type with `Success` and `Failure` variants
- **StructuredFailure** — Immutable failure value object with code, message, and context
- **HTTP Contracts** — Minimal `RequestInterface` and `ResponseInterface`

## Usage

```php
use Touta\Aria\Runtime\Result;
use Touta\Aria\Runtime\Success;
use Touta\Aria\Runtime\StructuredFailure;

$result = Success::of(42);
$mapped = $result->map(fn(int $v) => $v * 2); // Success(84)

$failure = Result::failure(new StructuredFailure('NOT_FOUND', 'Resource not found'));
$recovered = $failure->recover(fn($e) => 'default'); // Success('default')
```

## Quality

```bash
composer qa        # Full quality gate (lint + analyse + test)
composer test      # Run tests only
composer analyse   # PHPStan at max level
composer lint      # Check formatting
```

## License

MIT
