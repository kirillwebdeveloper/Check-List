<?php

namespace App\Tests\Service\Converter;

use App\Exception\Api\ApiException;
use App\Service\ChecklistService\Converter\ListConverter;
use App\Service\ChecklistService\Model\ListData;
use PHPUnit\Framework\TestCase;

/**
 * Class ListConverterTest
 * @package App\Tests\Service\Converter
 */
class ListConverterTest extends TestCase implements ListConverterEnum
{
    /**
     * @var ListConverter
     */
    protected $listConverter;

    public function setUp()
    {
        parent::setUp();

        $this->listConverter = new ListConverter();
    }

    public function testValidData()
    {
        $r = $this->listConverter->convert(self::VALID_DATA_1);

        $this->assertInstanceOf(ListData::class, $r);
        $this->assertEquals(3, count($r));
        $this->assertEquals(self::VALID_DATA_1_ARRAY, $r->getData());

        $r2 = $this->listConverter->convert(self::VALID_DATA_2);

        $this->assertInstanceOf(ListData::class, $r2);
        $this->assertEquals(2, count($r2));
        $this->assertEquals(self::VALID_DATA_2_ARRAY, $r2->getData());
    }

    public function testNonValidData()
    {
        $this->expectException(ApiException::class);

        $this->listConverter->convert(self::NON_VALID_DATA);
    }
}