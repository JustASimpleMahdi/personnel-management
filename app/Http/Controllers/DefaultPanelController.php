<?php

namespace App\Http\Controllers;

class DefaultPanelController extends Controller
{
    public function index()
    {
        return view('panel.index');
    }
}
