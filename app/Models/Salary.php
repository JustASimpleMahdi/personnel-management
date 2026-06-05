<?php

namespace App\Models;

use App\Classes\DayWorkHours;
use App\Classes\DayWorkHoursWithPenalty;
use App\SalaryShiftEnum;
use App\UserShiftEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Morilog\Jalali\Jalalian;

#[Fillable('year', 'month', 'shift', 'base_salary')]
class Salary extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Salary $salary) {
            $now = Jalalian::now();
            $salary->year = $now->getYear();
            $salary->month = $now->getMonth();
            $salary->shift = $salary->user->shift === UserShiftEnum::TWO_SHIFTS ? SalaryShiftEnum::TWO_SHIFT : SalaryShiftEnum::ONE_SHIFT;
            $salary->base_salary = $salary->user->salary;
        });
        static::updating(function (Salary $salary) {
            $now = Jalalian::now();
            if (!($salary->month === $now->getMonth() && $salary->year === $now->getYear())) return;
            $salary->shift = $salary->user->shift === UserShiftEnum::TWO_SHIFTS ? SalaryShiftEnum::TWO_SHIFT : SalaryShiftEnum::ONE_SHIFT;
            $salary->base_salary = $salary->user->salary;
        });
    }


    protected function total(): Attribute
    {
        return Attribute::get(function () {
            return $this->base_salary + $this->total_penalty;
        });
    }

    protected function totalPenalty(): Attribute
    {
        return Attribute::get(function () {
            return round(
                $this->every_day_of_month_worked_hours->sum('penalty')
            );
        });
    }

    protected function workedDays(): Attribute
    {
        return Attribute::get(function () {
            return $this->workHours()
                ->whereBetween('date', [$this->first_day_of_month->toCarbon(), $this->end_day_of_month->toCarbon()])
                ->get()
                ->groupBy('date')
                ->map(function ($workHours): DayWorkHours {
                    return new DayWorkHoursWithPenalty(
                        $workHours,
                        $this->calculateDayWorkHoursPenalty(new DayWorkHours($workHours))
                    );
                })->values();
        });

    }

    public function everyDayOfMonthWorkedHours(): Attribute
    {
        return Attribute::get(function () {
            return collect(range(0, $this->first_day_of_month->getMonthDays() - 1))
                ->map(fn($index) => $this->first_day_of_month->addDays($index))
                ->map(function (Jalalian $date) {
                    $workedDay = $this->worked_days->first(fn(DayWorkHours $day) => $date->equalsTo($day->date));
                    if ($workedDay) return $workedDay;
                    return new DayWorkHoursWithPenalty(
                        collect(),
                        $this->calculateDayWorkHoursPenalty(new DayWorkHours(collect(), date: $date)),
                        date: $date
                    );
                });
        });
    }

    private function calculateDayWorkHoursPenalty(DayWorkHours $dayWorkHours): float
    {
        $workedMinutes = 0;
        if ($dayWorkHours->morning)
            $workedMinutes += Carbon::parse($dayWorkHours->morning->start)->diffInMinutes(Carbon::parse($dayWorkHours->morning->end));
        if ($dayWorkHours->afternoon)
            $workedMinutes += Carbon::parse($dayWorkHours->afternoon->start)->diffInMinutes(Carbon::parse($dayWorkHours->afternoon->end));

        $baseWorkMinutes = config('work-hours.' . $this->shift->value);

        $salaryPerMinute = $this->base_salary / ($baseWorkMinutes * $dayWorkHours->date->getMonthDays());

        return ($workedMinutes - $baseWorkMinutes) * $salaryPerMinute;
    }

    protected function firstDayOfMonth(): Attribute
    {
        return Attribute::get(fn() => new Jalalian($this->year, $this->month, 1));
    }

    protected function endDayOfMonth(): Attribute
    {
        return Attribute::get(fn() => $this->first_day_of_month->getEndDayOfMonth());
    }

    public function workHours(): HasManyThrough
    {
        return $this->hasManyThrough(
            WorkHour::class,
            User::class,
            'id',
            'user_id',
            'user_id',
            'id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'month' => 'integer',
            'shift' => SalaryShiftEnum::class,
            'base_salary' => 'integer'
        ];
    }
}
