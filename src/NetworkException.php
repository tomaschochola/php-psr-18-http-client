<?php

declare(strict_types=1);

namespace TomasChochola\Psr\Http\Client;

use NoDiscard;
use Override;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface;
use RuntimeException;
use Throwable;

/**
 * @no-named-arguments
 */
class NetworkException extends RuntimeException implements NetworkExceptionInterface
{
    private readonly RequestInterface $request;

    public function __construct(RequestInterface $request, string $message = '', int $code = 0, Throwable | null $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->request = $request;
    }

    #[NoDiscard()]
    #[Override()]
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
