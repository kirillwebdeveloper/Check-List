<?php

namespace App\Tests\Service\Converter;

interface ListConverterEnum
{
    public const VALID_DATA_1       = 'test, test2, test3';
    public const VALID_DATA_1_ARRAY = ['test', 'test2', 'test3'];

    public const VALID_DATA_2       = 'test, test2 test in';
    public const VALID_DATA_2_ARRAY = ['test', 'test2 test in'];

    public const NON_VALID_DATA = ['test'];
}