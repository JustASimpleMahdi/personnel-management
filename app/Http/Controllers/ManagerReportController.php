<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ManagerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::paginate();
        return view('manager.reports.index', compact('reports'));
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
        }else{
            $report->manager_check()->delete();
        }
        return redirect()->route('manager.reports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
