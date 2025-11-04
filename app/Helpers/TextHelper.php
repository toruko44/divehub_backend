<?php

namespace App\Helpers;

class TextHelper
{
    public static function autoLinkUrls($text)
    {
        $pattern = '/(https?:\/\/[^\s]+)/';
        $replacement = '<a href="$1" target="_blank" class="text-blue-500 hover:underline">$1</a>';
        return preg_replace($pattern, $replacement, e($text));
    }
}
