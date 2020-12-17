<?php

namespace App\Listener;

use App\Enum\SerializationEnum\SerializationFormatEnum;
use App\Exception\Api\ValidationException;
use App\Exception\Json\MalformedJsonException;
use App\Service\CoreService\RestApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Class ExceptionMalformedJsonListener
 * @package App\Listener
 */
class ExceptionMalformedJsonListener
{
    /**
     * @var RestApiService
     */
    protected $restApiService;

    /**
     * ExceptionMalformedJsonListener constructor.
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

        if (!$exception instanceof MalformedJsonException) {
            return;
        }

        $responseContent = $this->restApiService->serializeErrors($exception->getMessage(), Response::HTTP_BAD_REQUEST);

        $event->setResponse($responseContent);
    }
}