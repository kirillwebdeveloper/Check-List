<?php

namespace App\Service\CoreService;

use App\Enum\SerializationEnum\SerializationFormatEnum;
use App\Exception\Api\ApiException;
use App\Exception\Api\ValidationException;
use App\Exception\Json\MalformedJsonException;
use App\Model\Response\ApiResponse;
use App\Service\JsonValidator\JsonValidator;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RestApiService
{
    /**
     * @var JsonValidator
     */
    protected $jsonValidator;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(
        JsonValidator $jsonValidator,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->jsonValidator = $jsonValidator;
        $this->serializer    = $serializer;
        $this->validator     = $validator;
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
        array $contexts     = ['get'],
        array $extraHeaders = [],
        string $format      = SerializationFormatEnum::JSON_FORMAT
    ): ApiResponse {
        $dataToBeSerialized = [
            'data' => $dataToBeSerialized,
        ];

        return $this->serializeWithoutWrapping($dataToBeSerialized, $responseCode, $contexts, $extraHeaders, $format);
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
    public function serializeErrors(
        $dataToBeSerialized,
        int $responseCode   = Response::HTTP_OK,
        array $contexts     = ['get'],
        array $extraHeaders = [],
        string $format      = SerializationFormatEnum::JSON_FORMAT
    ): ApiResponse {
        $dataToBeSerialized = [
            'data'   => [],
            'errors' => $dataToBeSerialized,
        ];

        return $this->serializeWithoutWrapping($dataToBeSerialized, $responseCode, $contexts, $extraHeaders, $format);
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
        array $contexts     = ['get'],
        array $extraHeaders = [],
        string $format      = SerializationFormatEnum::JSON_FORMAT
    ): ApiResponse {
        $responseData = null;

        $responseData = $this->serializer->serialize(
            $dataToBeSerialized,
            $format,
            SerializationContext::create()->setGroups($contexts)
        );

        $mainHeaders   = [
            'Content-Type' => 'application/json',
        ];
        $actualHeaders = $mainHeaders + $extraHeaders;

        return new ApiResponse($responseData, $responseCode, $actualHeaders);
    }

    /**
     *
     * @param string $requestData Request data containing JSON.
     * @param array  $contexts    The deserialization contexts.
     * @param string $className   The name of the class that should be deserialized.
     *
     * @return mixed
     * @throws ApiException
     * @throws MalformedJsonException
     */
    public function deserialize(string $requestData, array $contexts = [], string $className = '')
    {
        if (false === $this->jsonValidator->isJson($requestData)) {
            throw new MalformedJsonException();
        }

        if (!class_exists($className)) {
            throw new ApiException('Class not exists', 500);
        }

        try {
            return $this->serializer->deserialize(
                $requestData,
                $className,
                SerializationFormatEnum::JSON_FORMAT,
                DeserializationContext::create()->setGroups($contexts)
            );
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
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
        $validationErrors = $this->validator->validate($instance, $constraints = null, $validationGroups = null);

        if (0 !== $validationErrors->count()) {
            throw new ValidationException($validationErrors);
        }

        return true;
    }
}