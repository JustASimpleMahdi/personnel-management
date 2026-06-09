<?php

namespace App\Http\Controllers;

use App\Classes\DayWorkHours;
use App\Rules\TimeRule;
use Illuminate\Http\Request;

class WorkHourController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $workHours = $user->workHours()->latest()->get()
            ->groupBy('date')->values()->map(fn($workHours) => new DayWorkHours($workHours));
        $todayWorkHours = $user->today_work_hours;
        return view('panel.work-hours.index', compact('todayWorkHours', 'workHours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'morning.start' => ['nullable', new TimeRule('07:00', '23:00'), 'required_with:morning.end'],
            'morning.end' => ['nullable', new TimeRule('07:00', '23:00'), 'required_with:morning.start'],
            'afternoon.start' => ['nullable', new TimeRule('07:00', '23:00'), 'required_with:afternoon.end'],
            'afternoon.end' => ['nullable', new TimeRule('07:00', '23:00'), 'required_with:afternoon.start'],
        ]);

        if ($validated['morning']['start']) {
            if ($validated['morning']['start'] > $validated['morning']['end']) {
                return back()->withErrors(['morning.end' => 'پایان باید بعد از شروع باشد.']);
            }
        }

        if ($validated['afternoon']['start']) {
            if ($validated['afternoon']['start'] > $validated['afternoon']['end']) {
                return back()->withErrors(['afternoon.end' => 'پایان باید بعد از شروع باشد.']);
            }
        }

        if ($validated['morning']['start'] === null) {
            unset($validated['morning']);
        }
        if ($validated['afternoon']['start'] === null) {
            unset($validated['afternoon']);
        }
        if (count($validated) === 0) {
            return back()->withErrors(['shift' => 'حداقل یک شیفت باید پر شود.']);
        }
        if (count($validated) === 2) {
            if ($validated['morning']['end'] > $validated['afternoon']['start']) {
                return back()->withErrors(['shift' => 'زمان های شیفت صبح و بعد از ظهر نباید تداخل داشته باشند.']);
            }
        }

        foreach ($validated as $shift => $value) {
            auth()->user()->workHours()->updateOrCreate(
                [
                    'date' => now()->format('Y-m-d'),
                    'shift' => $shift
                ],
                [
                    'start' => $value['start'],
                    'end' => $value['end'],
                ]
            );
        }
        foreach (collect(['morning', 'afternoon'])->diff(collect($validated)->keys()) as $shift) {
            auth()->user()->workHours()->where('shift', $shift)->delete();
        }
        return back()->with('success', true);
    }
}
