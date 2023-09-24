<?php

namespace App\Helpers;

use Exception;

class ApiHelpers
{
    public static function getTypeIdFromApiUrl(string $url): string
    {
        $pattern = "/\/type\/(\d+)\/$/";

        if (!preg_match($pattern, $url, $matches)) {
            throw new Exception('Error getting types for seeding.');
        }

        return $matches[1];
    }
}
