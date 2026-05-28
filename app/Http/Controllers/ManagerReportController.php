<?php

namespace App\Http\Controllers;

use App\DateFilterTrait;
use App\Models\Report;
use App\Models\Role;
use App\RoleEnum;
use Illuminate\Http\Request;

class ManagerReportController extends Controller
{
    use DateFilterTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fromFilter = preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $request->input('from')) ? $request->input('from') : null;
        $toFilter = preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $request->input('to')) ? $request->input('to') : null;
        $rolesFilter = $request->collect('role')->map(fn($roleKey) => RoleEnum::tryFrom($roleKey))->reject(null);
        $seenFilter = filter_var($request->input('seen'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $reports = Report::query()
            ->filterByDateRange($fromFilter, $toFilter)
            ->filterByRoles($rolesFilter)
            ->filterBySeen($seenFilter)
            ->latest('updated_at')
            ->paginate();

        $roles = Role::whereNot('key', RoleEnum::MANAGER)->get();
        return view('manager.reports.index', compact('reports', 'roles'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        return view('manager.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'seen' => 'boolean',
            'response' => 'nullable',
        ]);
        if (isset($validated['seen']) && $validated['seen']) {
            $report->manager_check()->updateOrCreate(
                ['manager_id' => auth()->id()],
                ['seen' => true, 'response' => $validated['response'], 'manager_id' => auth()->id()]
            );
        } else {
            $report->manager_check()->delete();
        }
        return redirect()->route('manager.reports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Report $report)
    {
        return view('manager.reports.delete', compact('report'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('manager.reports.index');
    }
}
