<?php

namespace App\Controller\Api;

use App\Enum\SerializationEnum\SerializationFormatEnum;
use App\Exception\Api\ApiException;
use App\Exception\Api\ValidationException;
use App\Exception\Json\MalformedJsonException;
use App\Model\Response\ApiResponse;
use App\Service\CoreService\RestApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Core Controller for Rest API
 *
 * Class CoreRestApiController
 * @package App\Controller\Api
 */
class CoreRestApiController extends AbstractController
{
    /**
     * @var RestApiService
     */
    protected $restApiService;

    /**
     * CoreRestApiController constructor.
     *
     * @param RestApiService $restApiService
     */
    public function __construct(
        RestApiService $restApiService
    ) {
        $this->restApiService = $restApiService;
    }

    /**
     * Serialize an object, wrapping it within a data block.
     *
     * @param mixed  $dataToBeSerialized
     * @param int    $responseCode
     * @param array  $contexts
     * @param array  $extraHeaders
     * @param string $format
     *
     * @return ApiResponse
     */
    public function serialize(
        $dataToBeSerialized,
        int $responseCode   = Response::HTTP_OK,
        array $contexts     = [],
        array $extraHeaders = [],
        string $format      = SerializationFormatEnum::JSON_FORMAT
    ): ApiResponse {
        return $this->restApiService->serialize(
            $dataToBeSerialized,
            $responseCode,
            $contexts,
            $extraHeaders,
            $format
        );
    }

    /**
     * Serialize an object, without wrapping it.
     *
     * @param mixed  $dataToBeSerialized
     * @param int    $responseCode
     * @param array  $contexts
     * @param array  $extraHeaders
     * @param string $format
     *
     * @return ApiResponse
     */
    public function serializeWithoutWrapping(
        $dataToBeSerialized,
        int $responseCode   = Response::HTTP_OK,
        array $contexts     = [],
        array $extraHeaders = [],
        string $format      = SerializationFormatEnum::JSON_FORMAT
    ): ApiResponse {
        return $this->restApiService->serializeWithoutWrapping(
            $dataToBeSerialized,
            $responseCode,
            $contexts,
            $extraHeaders,
            $format
        );
    }

    /**
     * Deserialize request data into an object using
     * the serializer and the rules found in the annotations
     * associated to the entity.
     *
     * @param string $requestData Request data containing JSON.
     * @param array  $contexts    The deserialization contexts.
     * @param string $className   The name of the class that should be deserialized.
     *
     * @return mixed
     *
     * @throws ApiException
     * @throws MalformedJsonException
     */
    public function deserialize(string $requestData, array $contexts = [], string $className = '')
    {
        return $this->restApiService->deserialize(
            $requestData,
            $contexts,
            $className
        );
    }

    /**
     * Validate an instance
     *
     * @param $instance
     *
     * @return bool|\Symfony\Component\Validator\ConstraintViolationListInterface
     *
     * @throws ValidationException
     */
    public function validate($instance)
    {
        return $this->restApiService->validate($instance);
    }
}