<?php
// app/Http/Controllers/TeamController.php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created team in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'role' => 'nullable|string|max:255',
        ]);

        Team::create($request->all());

        return back()->with('success', 'Team added successfully!');
    }
}