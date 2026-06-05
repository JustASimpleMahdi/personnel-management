<?php

namespace App\Classes;

use App\Models\WorkHour;
use App\WorkHourShiftEnum;
use Morilog\Jalali\Jalalian;

class DayWorkHours
{
    public Jalalian $date;
    public ?WorkHour $morning;
    public ?WorkHour $afternoon;

    public function __construct($workHours, ?Jalalian $date = null)
    {
        $this->morning = $workHours->where('shift', WorkHourShiftEnum::MORNING)->first();
        $this->afternoon = $workHours->where('shift', WorkHourShiftEnum::AFTERNOON)->first();
        $this->date = $workHours->first()?->date ?? $date;
    }
}
