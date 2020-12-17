<?php

namespace App\Tests\Service\ChecklistService;

use App\Service\ChecklistService\Checker\CheckerInterface;
use App\Service\ChecklistService\Checker\SimpleChecker;
use App\Service\ChecklistService\Model\CheckInformation;
use App\Service\ChecklistService\Model\ListData;
use PHPUnit\Framework\TestCase;

/**
 * Class CheckerTest
 * @package App\Tests\Service\ChecklistService
 */
class CheckerTest extends TestCase implements CheckerDataEnum
{
    /**
     * @var CheckerInterface
     */
    protected $checker;

    /**
     * @var ListData
     */
    protected $list;

    public function setUp()
    {
        parent::setUp();

        $this->checker = new SimpleChecker();
        $this->list    = new ListData(self::DATA);
    }

    public function testChecker()
    {
        $r = $this->checker->checkContent(
            $this->list,
            self::CONTENT
        );

        $this->assertInstanceOf(CheckInformation::class, $r);
        $this->assertEquals(self::ACTUAL_WORD_SUM, $r->getWordSumm());
        $this->assertEquals(self::ACTUAL_WORD_USED, $r->getWordUsed());
        $this->assertEquals(self::ACTUAL_AVERAGE, $r->getAverage());
    }
}