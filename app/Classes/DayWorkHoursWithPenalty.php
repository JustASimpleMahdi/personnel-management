<?php

namespace App\Classes;

use Morilog\Jalali\Jalalian;

class DayWorkHoursWithPenalty extends DayWorkHours
{

    public float $penalty;

    public function __construct($workHours, float $penalty, ?Jalalian $date = null)
    {
        parent::__construct($workHours, $date);
        $this->penalty = $penalty;
    }
}
