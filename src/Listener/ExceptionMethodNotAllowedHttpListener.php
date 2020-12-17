<?php

namespace App\Listener;

use App\Exception\Api\ValidationException;
use App\Service\CoreService\RestApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * Class ExceptionMethodNotAllowedHttpListener
 * @package App\Listener
 */
class ExceptionMethodNotAllowedHttpListener
{
    /**
     * @var RestApiService
     */
    protected $restApiService;

    /**
     * ExceptionMethodNotAllowedHttpListener constructor.
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

        if (!$exception instanceof MethodNotAllowedHttpException) {
            return;
        }

        $responseContent = $this->restApiService->serializeErrors($exception->getMessage(), Response::HTTP_METHOD_NOT_ALLOWED);

        $event->setResponse($responseContent);
    }
}