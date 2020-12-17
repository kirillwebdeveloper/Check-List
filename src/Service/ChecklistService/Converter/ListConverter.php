<?php

namespace App\Service\ChecklistService\Converter;

use App\Exception\Api\ApiException;
use App\Service\ChecklistService\Model\ListData;

/**
 * Class ListConverter
 * @package App\Service\ChecklistService\Converter
 */
class ListConverter implements ListConverterInterface
{
    /**
     * @param $params
     *
     * @return ListData
     *
     * @throws ApiException
     */
    public function convert($params): ListData
    {
        if (!is_string($params)) {
            throw new ApiException('Cannot convert. Input param not string.');
        }

        $resultArray = array_map(function ($value) {
            return trim(preg_replace('/[^A-Za-z0-9\-\'\s]/', '', $value));
        }, explode(',', $params));

        return (new ListData($resultArray));
    }
}