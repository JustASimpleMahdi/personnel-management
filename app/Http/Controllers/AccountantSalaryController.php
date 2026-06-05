<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\RoleEnum;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class AccountantSalaryController extends Controller
{
    public function index(Request $request)
    {
        $year = (int)$request->year ?? Jalalian::now()->getYear();
        $month = (int)$request->month ?? Jalalian::now()->getMonth();

        $date = new Jalalian($year, $month, 1);

        $employees = User::has('role', callback: function ($builder) {
            $builder->whereNot('key', RoleEnum::MANAGER);
        })->get();

        $today = Jalalian::now();
        $isCurrentMonth = $year === $today->getYear() && $month === $today->getMonth();

        if ($isCurrentMonth) {
            $employees->each(function ($employee) {
                $employee->currentMonthSalary()->firstOrCreate();
            });
            $employees->load('currentMonthSalary');
        } else {
            $employees->each(function ($employee) use ($year, $month) {
                $employee->setAttribute('month_salary', $employee->monthSalary($year, $month));
            });
        }

        return view('accountant.salaries.index', compact('employees', 'date', 'isCurrentMonth'));
    }
}
