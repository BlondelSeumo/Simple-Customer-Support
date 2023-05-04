<?php

namespace App\Actions;

class RandomColor
{
    public static function generate()
    {
        return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
