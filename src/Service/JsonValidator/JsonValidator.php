<?php

namespace App\Service\JsonValidator;

/**
 * Json Validator
 *
 * Class JsonValidator
 * @package App\Service\JsonValidator
 */
class JsonValidator
{
    /**
     * @param string $stringToCheck
     *
     * @return bool
     */
    public function isJson(string $stringToCheck): bool
    {
        return is_string($stringToCheck)
            && is_array(json_decode($stringToCheck, true))
            && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}