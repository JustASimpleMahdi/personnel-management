<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportFile;
use App\Services\FileService;
use DB;
use Illuminate\Http\Request;

class EmployeeReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::where('user_id',auth()->id())->latest()->paginate();
        return view('reports.index',compact('reports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'files' => 'array',
            'files.*' => 'file|mimes:jpeg,jpg,png,webp,pdf,doc,docx,ppt,pptx,xls,xlsx,pdf|max:5120'
        ]);
        DB::transaction(function () use ($validated) {
            $user = auth()->user();
            $report = $user->reports()->create(collect($validated)->except('files')->toArray());

            $new_report_files = collect($validated['files'] ?? [])
                ->map(fn($file) => FileService::upload($file, path: "report-file/user-{$user->id}/report-$report->id"))
                ->pluck('id')->map(fn($id) => ['file_id' => $id, 'report_id' => $report->id]);

            $new_report_files->each(fn($array) => ReportFile::create($array));
        });
        return redirect()->route('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
