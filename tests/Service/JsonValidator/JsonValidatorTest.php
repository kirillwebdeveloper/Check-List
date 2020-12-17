<?php

namespace App\Tests\Service\JsonValidator;

use App\Service\JsonValidator\JsonValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonValidatorTest
 * @package App\Tests\Service\JsonValidator
 */
class JsonValidatorTest extends TestCase
{
    /**
     * @var JsonValidator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jsonServiceMock;

    /**
     * @throws \ReflectionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->jsonServiceMock = $this->getMockBuilder(JsonValidator::class)
            ->enableOriginalClone()
            ->enableProxyingToOriginalMethods()
            ->getMock();
    }

    public function testValidJson()
    {
        $json =
        "{
            \"test\":\"json\"
        }";

        $this->assertTrue($this->jsonServiceMock->isJson($json));
    }

    public function testNotValidJson()
    {
        $json =
        "{
            test
            \"test\":\"json\"
        }";

        $this->assertFalse($this->jsonServiceMock->isJson($json));
    }
}