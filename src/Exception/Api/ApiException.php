<?php

namespace App\Exception\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * Api Exception
 *
 * Class ApiException
 * @package App\Exception\Api
 */
class ApiException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Internal error';

    /**
     * @var int
     */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}