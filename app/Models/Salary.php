<?php

namespace App\Models;

use App\Classes\DayWorkHours;
use App\SalaryShiftEnum;
use App\UserShiftEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
            $workedHours = $this->worked_hours->groupBy('date');

            return round(
                collect(range(0, $this->first_day_of_month->getMonthDays() - 1))
                    ->map(fn($index) => $this->first_day_of_month->addDays($index))
                    ->map(function (Jalalian $date) use ($workedHours) {
                        if ($workedHours->has($date->toString())) {
                            return new DayWorkHours($workedHours->get($date->toString()));
                        }
                        return new DayWorkHours(collect(), $date);
                    })
                    ->map(fn($dayWorkHours) => $this->calculateDayWorkHoursPenalty($dayWorkHours))
                    ->sum()
            );
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

    protected function workedHours(): Attribute
    {
        return Attribute::get(fn() => $this->hasManyThrough(WorkHour::class, User::class, 'id', 'user_id', 'user_id', 'id')
            ->whereBetween('date', [$this->first_day_of_month->toCarbon(), $this->end_day_of_month->toCarbon()])->get()
        );

    }

    protected function firstDayOfMonth(): Attribute
    {
        return Attribute::get(fn() => new Jalalian($this->year, $this->month, 1));
    }

    protected function endDayOfMonth(): Attribute
    {
        return Attribute::get(fn() => $this->first_day_of_month->getEndDayOfMonth());
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
