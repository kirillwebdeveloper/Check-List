<?php

namespace App\Service\ChecklistService\Exception;

use App\Exception\Api\ApiException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ServiceExpectException
 * @package App\Service\ChecklistService\Exception
 */
class ServiceExpectException extends ApiException
{
    /**
     * @var string
     */
    protected $message = 'All services must be provided.';

    /**
     * @var int
     */
    protected $code = Response::HTTP_SERVICE_UNAVAILABLE;
}