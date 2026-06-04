<?php

namespace App\Classes;

use App\Models\WorkHour;
use App\WorkHourShiftEnum;
use Illuminate\Support\Collection;
use Morilog\Jalali\Jalalian;

class DayWorkHours
{
    public Jalalian $date;
    public ?WorkHour $morning;
    public ?WorkHour $afternoon;

    public function __construct(Collection $workHours)
    {
        $this->morning = $workHours->where('shift', WorkHourShiftEnum::MORNING)->first();
        $this->afternoon = $workHours->where('shift', WorkHourShiftEnum::AFTERNOON)->first();
        $this->date = $workHours->firstOrFail()->date;
    }
}
