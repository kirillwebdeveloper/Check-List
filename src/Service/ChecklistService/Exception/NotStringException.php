<?php

namespace App\Service\ChecklistService\Exception;

use App\Exception\Api\ApiException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NotStringException
 * @package App\Service\ChecklistService\Exception
 */
class NotStringException extends ApiException
{
    /**
     * @var string
     */
    protected $message = 'String expected.';

    /**
     * @var int
     */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}