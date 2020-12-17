<?php

namespace App\Listener;

use App\Exception\Api\ApiException;
use App\Exception\Api\ValidationException;
use App\Service\CoreService\RestApiService;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Class ApiExceptionListener
 * @package App\Listener
 */
class ApiExceptionListener
{
    /**
     * @var RestApiService
     */
    protected $restApiService;

    /**
     * ValidationExceptionListener constructor.
     *
     * @param RestApiService $restApiService
     */
    public function __construct(
        RestApiService $restApiService
    ) {
        $this->restApiService = $restApiService;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        /** @var ValidationException $exception */
        $exception = $event->getThrowable();

        if (!$exception instanceof ApiException) {
            return;
        }

        $responseContent = $this->restApiService->serializeErrors($exception->getMessage(), $exception->getCode());

        $event->setResponse($responseContent);
    }
}