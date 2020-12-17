<?php

namespace App\Exception\Json;

use App\Exception\Api\ApiException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MalformedJsonException
 * @package App\Exception\Json
 */
class MalformedJsonException extends ApiException
{
    /**
     * @var string
     */
    protected $message = 'Malformed JSON request';

    /**
     * @var int
     */
    protected $code = Response::HTTP_BAD_REQUEST;
}