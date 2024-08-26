<?php

namespace App\Helper;

use Carbon\Carbon;

class DateTimeParser
{
    /**
     * Format a timestamp into a human-readable date string.
     *
     * @param string|null $timestamp The timestamp to format.
     * @param string $format The format to return the date in.
     * @return string The formatted date string.
     */
    public static function parse(?string $timestamp, string $format = 'l, j F Y'): string
    {
        if ($timestamp == null) {
            return "";
        }

        return Carbon::parse($timestamp)->translatedFormat($format);
    }

    /**
     * Convert a formatted date string to an ISO 8601 date-time string.
     *
     * @param string|null $formattedDate The formatted date string in Indonesian.
     * @param string $format The format of the date string.
     * @return string|null The ISO 8601 date-time string or null if the date is invalid.
     */
    public static function parseToTimestamp(?string $formattedDate, string $format = 'l, j F Y'): ?string
    {
        if ($formattedDate === null) {
            return null;
        }

        // Define mappings for days and months in Indonesian
        $days = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
            'Sabtu' => 'Saturday',
            'Minggu' => 'Sunday',
        ];

        $months = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        // Replace Indonesian day and month names with English equivalents
        $formattedDate = str_replace(array_keys($days), array_values($days), $formattedDate);
        $formattedDate = str_replace(array_keys($months), array_values($months), $formattedDate);

        try {
            // Parse the formatted date string into a Carbon instance
            $carbonDate = Carbon::createFromFormat($format, $formattedDate, 'UTC');

            // Return ISO 8601 format date-time string
            return $carbonDate->toIso8601String();
        } catch (\Exception $e) {
            // Return null if the date is invalid
            return null;
        }
    }

}
