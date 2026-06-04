<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class EmployeeSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = auth()->user()->suggestions()->latest()->paginate();

        return view('panel.suggestions.index', compact('suggestions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'text' => 'required',
        ]);
        auth()->user()->suggestions()->create($validated);
        return redirect()->route('suggestions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.suggestions.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Suggestion $suggestion)
    {
        return view('panel.suggestions.show', compact('suggestion'));
    }
}
