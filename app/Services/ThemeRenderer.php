<?php

namespace App\Services;

class ThemeRenderer
{
    /**
     * default.json ile
     * database'deki settings'i birleştirir.
     */
    public function render(array $defaults, array $settings): array
    {
        return array_replace_recursive(
            $defaults,
            $settings
        );
    }
}