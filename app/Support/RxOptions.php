<?php

namespace App\Support;

class RxOptions
{
    public static function decimalRange(float $min, float $max, float $step = 0.25): array
    {
        $options = [];
        $count = (int) round(($max - $min) / $step);

        for ($i = 0; $i <= $count; $i++) {
            $options[] = round($min + ($i * $step), 2);
        }

        return $options;
    }

    public static function integerRange(int $min, int $max): array
    {
        return range($min, $max);
    }

    public static function formatLabel(float $value, bool $showPlus = true): string
    {
        if ($showPlus && $value > 0) {
            return '+'.number_format($value, 2);
        }

        return number_format($value, 2);
    }

    public static function isSelected(mixed $current, float|int $option): bool
    {
        if ($current === null || $current === '') {
            return false;
        }

        return abs((float) $current - (float) $option) < 0.001;
    }
}
