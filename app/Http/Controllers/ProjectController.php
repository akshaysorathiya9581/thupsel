<?php
// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Site;

class ProjectController extends Controller
{   

    public function create()
    {   $sites = Site::all();

        return view('project.create', compact('sites'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:projects,name',
            'site_id' => 'required|exists:sites,id',
        ]);

        Project::create($request->all());

        return back()->with('success', 'Project added successfully!');
    }
}