<?php

namespace App\Service\ChecklistService;

use App\Service\ChecklistService\Checker\SimpleChecker;
use App\Service\ChecklistService\Converter\ListConverter;

/**
 * Factory for Checker
 *
 * Class CheckListFactory
 * @package App\Service\ChecklistService
 */
class CheckListFactory
{
    /**
     * @param SimpleChecker $checker
     * @param ListConverter $listConverter
     *
     * @return AbstractChecker|CheckList
     */
    public static function createChecker(
        SimpleChecker $checker,
        ListConverter $listConverter
    ) {
        return (new CheckList())
            ->setChecker($checker)
            ->setListConverter($listConverter);
    }
}