<?php

namespace App\Service\ChecklistService\Converter;

use App\Service\ChecklistService\Model\ListData;

/**
 * Interface ListConverterInterface
 * @package App\Service\ChecklistService\Converter
 */
interface ListConverterInterface
{
    /**
     * @param $param
     *
     * @return ListData
     */
    public function convert($param): ListData;
}