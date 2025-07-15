<?php
// app/Http/Controllers/SiteController.php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function create()
    {
        return view('site.create');
    }

    /**
     * Store a newly created site in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sites,name',
            'location' => 'nullable|string|max:255',
        ]);

        Site::create($request->all());

        return back()->with('success', 'Site added successfully!');
    }
}