<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\RequestInterface;
use RuntimeException;
use TomasChochola\Psr\Http\Client\NetworkException;

/**
 * @internal
 *
 * @no-named-arguments
 */
#[CoversClass(NetworkException::class)]
#[Small()]
final class NetworkExceptionTest extends TestCase
{
    #[Test()]
    public function preservesRequestAndExceptionContext(): void
    {
        $request = self::createStub(RequestInterface::class);
        $previous = new RuntimeException('Previous failure');
        $exception = new NetworkException($request, 'Network failure', 23, $previous);

        self::assertSame($request, $exception->getRequest());
        self::assertSame('Network failure', $exception->getMessage());
        self::assertSame(23, $exception->getCode());
        self::assertSame($previous, $exception->getPrevious());
    }
}
