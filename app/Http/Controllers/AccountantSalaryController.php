<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\User;
use App\RoleEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Morilog\Jalali\Jalalian;

class AccountantSalaryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'year' => 'required|integer|min:1380|max:3000',
                'month' => 'required|integer|min:1|max:12',
            ]);
            $year = $request->year;
            $month = $request->month;
        } catch (ValidationException) {
            $year = Jalalian::now()->getYear();
            $month = Jalalian::now()->getMonth();
        }

        $date = new Jalalian($year, $month, 1);

        $employees = User::has('role', callback: function ($builder) {
            $builder->whereNot('key', RoleEnum::MANAGER);
        })->orderBy('lastname')->orderBy('firstname')->get();

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

    public function show(Salary $salary)
    {
        $salary->load('user');
        return view('accountant.salaries.show', compact('salary'));
    }
}
