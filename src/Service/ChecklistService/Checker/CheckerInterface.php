<?php

namespace App\Service\ChecklistService\Checker;

use App\Service\ChecklistService\Model\CheckInformation;
use App\Service\ChecklistService\Model\ListData;

/**
 * Interface CheckerInterface
 * @package App\Service\ChecklistService\Checker
 */
interface CheckerInterface
{
    /**
     * @param ListData  $listData
     * @param string    $content
     * @param int       $round
     *
     * @return CheckInformation
     */
    public function checkContent(ListData $listData, string $content, $round = 3): CheckInformation;
}