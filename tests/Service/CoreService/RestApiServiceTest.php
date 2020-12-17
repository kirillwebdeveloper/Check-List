<?php

namespace App\Tests\Service\CoreService;

use App\Model\Response\ApiResponse;
use App\Service\CoreService\RestApiService;
use App\Service\JsonValidator\JsonValidator;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RestApiServiceTest
 * @package App\Tests\Service\CoreService]
 */
class RestApiServiceTest extends TestCase
{
    public const DATA                           = ['test' => 'Test Name'];

    public const DATA_SERIALIZE_WITH_WRAP       = '{"data":{"test":"Test Name"}}';
    public const DATA_SERIALIZE_WITH_WRAP_ERROR = '{"data":"", "error": {"test":"Test Name"}}';
    public const DATA_SERIALIZE                 = '{"test":"Test Name"}';

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var JsonValidator
     */
    protected $jsonValidator;

    public function setUp()
    {
        parent::setUp();

        $this->validator          = $this->createMock(ValidatorInterface::class);
        $this->jsonValidator      = $this->createMock(JsonValidator::class);
    }

    public function testDataWithWrap()
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->serializer->expects($this->any())
            ->method('serialize')
            ->with(['data' => self::DATA], 'json', SerializationContext::create()->setGroups(['get']))
            ->willReturn(self::DATA_SERIALIZE_WITH_WRAP);

        $restApiService = new RestApiService(
            $this->jsonValidator,
            $this->serializer,
            $this->validator
        );

        $response = $restApiService->serialize(
            self::DATA
        );

        $this->assertInstanceOf(ApiResponse::class, $response);
        $this->assertEquals(self::DATA_SERIALIZE_WITH_WRAP, $response->getContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDataWithoutWrap()
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->serializer->expects($this->any())
            ->method('serialize')
            ->with(self::DATA, 'json', SerializationContext::create()->setGroups(['get']))
            ->willReturn(self::DATA_SERIALIZE);

        $restApiService = new RestApiService(
            $this->jsonValidator,
            $this->serializer,
            $this->validator
        );

        $response = $restApiService->serializeWithoutWrapping(
            self::DATA
        );

        $this->assertInstanceOf(ApiResponse::class, $response);
        $this->assertEquals(self::DATA_SERIALIZE, $response->getContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDataWithError()
    {
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->serializer->expects($this->any())
            ->method('serialize')
            ->with([
                'data'   => [],
                'errors' => self::DATA
            ], 'json', SerializationContext::create()->setGroups(['get']))
            ->willReturn(self::DATA_SERIALIZE_WITH_WRAP_ERROR);

        $restApiService = new RestApiService(
            $this->jsonValidator,
            $this->serializer,
            $this->validator
        );

        $response = $restApiService->serializeErrors(
            self::DATA
        );

        $this->assertInstanceOf(ApiResponse::class, $response);
        $this->assertEquals(self::DATA_SERIALIZE_WITH_WRAP_ERROR, $response->getContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}