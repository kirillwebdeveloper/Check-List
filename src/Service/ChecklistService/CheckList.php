<?php

namespace App\Service\ChecklistService;

use App\Model\Request\Api\Checklist\ChecklistRequest;
use App\Model\Response\Api\Checklist\ChecklistResponse;

/**
 * Class CheckList
 * @package App\Service\ChecklistService
 */
class CheckList extends AbstractChecker
{
    /**
     * @param ChecklistRequest $checklistRequest
     *
     * @return ChecklistResponse
     */
    protected function buildCheck(ChecklistRequest $checklistRequest): ChecklistResponse
    {
        $listData         = $this->listConverter
            ->convert($checklistRequest->getList());
        $checkInformation = $this->checker
            ->checkContent($listData, $checklistRequest->getContent());

        return (new ChecklistResponse())
            ->setContent($checklistRequest->getContent())
            ->setAverageKeywordsDensity($checkInformation->getAverage())
            ->setKeywordsUsed($checkInformation->getWordUsed());
    }
}