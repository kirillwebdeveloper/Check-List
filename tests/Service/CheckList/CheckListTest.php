<?php

namespace App\Tests\Service\CheckList;

use App\Model\Request\Api\Checklist\ChecklistRequest;
use App\Model\Response\Api\Checklist\ChecklistResponse;
use App\Service\ChecklistService\Checker\CheckerInterface;
use App\Service\ChecklistService\Checker\SimpleChecker;
use App\Service\ChecklistService\CheckList;
use App\Service\ChecklistService\Converter\ListConverter;
use App\Service\ChecklistService\Converter\ListConverterInterface;
use App\Service\ChecklistService\Exception\ServiceExpectException;
use App\Service\ChecklistService\Model\ListData;
use PHPUnit\Framework\TestCase;

/**
 * Class CheckListTest
 * @package App\Tests\Service\CheckList
 */
class CheckListTest extends TestCase implements DataRequestEnum
{
    /**
     * @var ListConverterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $listConverterMock;

    /**
     * @var CheckerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $checkerMock;

    /**
     * @var ChecklistRequest
     */
    protected $checklistRequest;

    /**
     * @var ListData
     */
    protected $listData;

    public function setUp()
    {
        parent::setUp();

        $this->listData = new ListData(self::DATA_ARRAY);

        $this->listConverterMock = $this->createMock(ListConverter::class);
        $this->checkerMock       = $this->createMock(SimpleChecker::class);
        $this->checklistRequest  = (new ChecklistRequest())
            ->setList(self::DATA)
            ->setContent(self::CONTENT);
    }

    public function testThrowExceptionIfNotSetList()
    {
        $this->expectException(ServiceExpectException::class);

        $checkList = (new CheckList());

        $checkList->check($this->checklistRequest);
    }

    public function testChecker()
    {
        $checkList = (new CheckList())
            ->setChecker($this->checkerMock)
            ->setListConverter($this->listConverterMock);

        $r = $checkList->check($this->checklistRequest);

        $this->assertInstanceOf(ChecklistResponse::class, $r);
    }
}