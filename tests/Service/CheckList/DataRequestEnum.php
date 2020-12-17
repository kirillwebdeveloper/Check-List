<?php

namespace App\Tests\Service\CheckList;

interface DataRequestEnum
{
    public const DATA       = 'Lorem, elit, apple';
    public const DATA_ARRAY = [
        'Lorem', 'elit', 'apple'
    ];

    public const CONTENT = 'Lorem ipsum dolor sit amet, 
                            consectetur adipiscing elit, 
                            sed do eiusmod tempor incididunt ut labore 
                            et dolore magna aliqua lorem. 
                            Not elit every one for elit';

    public const ACTUAL_WORD_SUM  = 26;
    public const ACTUAL_WORD_USED = 2;
    public const ACTUAL_AVERAGE   = 0.077;
}