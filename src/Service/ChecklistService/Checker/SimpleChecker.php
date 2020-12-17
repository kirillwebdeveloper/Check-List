<?php

namespace App\Service\ChecklistService\Checker;

use App\Service\ChecklistService\Model\CheckInformation;
use App\Service\ChecklistService\Model\ListData;

/**
 * Class SimpleChecker
 * @package App\Service\ChecklistService\Checker
 */
class SimpleChecker implements CheckerInterface
{
    /**
     * @param ListData $listData
     * @param string $content
     * @param int $round
     *
     * @return CheckInformation
     */
    public function checkContent(ListData $listData, string $content, $round = 3): CheckInformation
    {
        $information = (new CheckInformation())
            ->setWordSumm(str_word_count($content));

        $matches = [];

        foreach ($listData as $item) {
            preg_match_all('/' . $item . '/', $content, $matches, PREG_SET_ORDER);

            if (count($matches) > 0) {
                $information->setWordUsed(
                    $information->getWordUsed() + 1
                );
            }

            $matches = [];
        }

        $information->setAverage(
            round((int)$information->getWordUsed() / $information->getWordSumm(), $round)
        );

        return $information;
    }
}