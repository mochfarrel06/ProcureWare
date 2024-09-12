<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function addBusinessDays($startDate, $days)
    {
        $businessDays = 0;
        $date = Carbon::parse($startDate);

        while ($businessDays < $days) {
            $date->addDay();

            // Hanya tambahkan jika hari kerja (Senin–Jumat)
            if (!$date->isWeekend()) {
                $businessDays++;
            }
        }

        return $date;
    }
}
