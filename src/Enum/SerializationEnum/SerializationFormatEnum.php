<?php

namespace App\Enum\SerializationEnum;

use App\Enum\EnumInterface;

/**
 * Get serialization formats
 *
 * Class SerializationFormatEnum
 * @package App\Enum\SerializationEnum
 */
final class SerializationFormatEnum implements EnumInterface
{
    const JSON_FORMAT = 'json';
    const XML_FORMAT  = 'xml';
}