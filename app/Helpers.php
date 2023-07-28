<?php

if (!function_exists('format_cop')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @return string
     */
    function format_cop(float $value): string
    {
        return "$" . number_format($value, 0, ',', '.');
    }
}
