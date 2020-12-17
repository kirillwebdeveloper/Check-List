<?php

namespace App\Listener;

use App\Exception\Api\ValidationException;
use App\Service\CoreService\RestApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Class ValidationExceptionListener
 * @package App\Listener
 */
class ValidationExceptionListener
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

        if (!$exception instanceof ValidationException) {
            return;
        }
        $constraintViolations = $exception->getConstraintViolations();

        $responseContent = $this->restApiService->serializeErrors($constraintViolations, Response::HTTP_BAD_REQUEST);

        $event->setResponse($responseContent);
    }
}