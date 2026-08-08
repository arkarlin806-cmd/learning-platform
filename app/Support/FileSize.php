<?php

namespace App\Support;

class FileSize
{
    public static function mbToBytes(int|float $mb): int
    {
        return (int) round($mb * 1024 * 1024);
    }
}
