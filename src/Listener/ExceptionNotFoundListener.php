<?php

namespace App\Listener;

use App\Exception\Api\ValidationException;
use App\Service\CoreService\RestApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExceptionNotFoundListener
 * @package App\Listener
 */
class ExceptionNotFoundListener
{
    /**
     * @var RestApiService
     */
    protected $restApiService;

    /**
     * ExceptionNotFoundListener constructor.
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

        if (!$exception instanceof NotFoundHttpException) {
            return;
        }

        $responseContent = $this->restApiService->serializeErrors($exception->getMessage(), Response::HTTP_NOT_FOUND);

        $event->setResponse($responseContent);
    }
}