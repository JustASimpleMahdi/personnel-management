<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class ManagerSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fromFilter = preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $request->input('from')) ? $request->input('from') : null;
        $toFilter = preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $request->input('to')) ? $request->input('to') : null;

        $suggestions = Suggestion::filterByDateRange($fromFilter, $toFilter)
            ->latest()
            ->paginate();

        return view('manager.suggestions.index', compact('suggestions'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {
        return view('manager.suggestions.show', compact('suggestion'));
    }

}
