<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Team;
use App\Models\Site;
use App\Models\Project;
use App\Models\PartUsageHistory;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the parts.
     */
    public function index()
    {
        $parts = Part::all();
        $sites = Site::all();
        return view('parts.index', compact('parts', 'sites'));
    }

    /**
     * Display the specified part details and history.
     */
    public function show(Part $part)
    {
        // Load relationships for the part details page
        $part->load([
            'usageHistory' => function($query) {
                $query->with('team', 'site', 'project')->latest('date_used');
            },
        ]);

        // Get current assignments (simplified: parts not returned from usage history)
        $currentAssignments = $part->currentAssignments();

        // Inventory usage counts
        $inStock = $part->current_stock;
        $totalUsedCount = $part->total_used; // Using the accessor
        $totalPurchased = $part->total_quantity;
        $inUse = $part->usageHistory()->where('returned', false)->count();
        $damaged = $part->usageHistory()->where('condition_after_use', 'Damaged')->count();
        $lost = $part->usageHistory()->where('condition_after_use', 'Lost')->count();
        $sites = Site::all();

        return view('parts.show', compact(
            'part',
            'currentAssignments',
            'inStock',
            'totalUsedCount',
            'totalPurchased',
            'inUse',
            'damaged',
            'lost',
            'sites'
        ));
    }

    /**
     * Show the form for creating a new part.
     */
    public function create()
    {
        return view('parts.create');
    }

    /**
     * Store a newly created part in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:parts|max:255',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'status' => 'required|string|in:In Use,In Stock,Under Repair',
            'serial_number' => 'nullable|string|max:255',
            'total_quantity' => 'required|integer|min:0',
            'current_stock' => 'required|integer|min:0|lte:total_quantity',
        ]);

        Part::create($request->all());

        return redirect()->route('parts.index')->with('success', 'Part created successfully.');
    }

    /**
     * Show the form for editing the specified part.
     */
    public function edit(Part $part)
    {
        return view('parts.edit', compact('part'));
    }

    /**
     * Update the specified part in storage.
     */
    public function update(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:parts,code,' . $part->id . '|max:255',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'status' => 'required|string|in:In Use,In Stock,Under Repair',
            'serial_number' => 'nullable|string|max:255',
            'total_quantity' => 'required|integer|min:0',
            'current_stock' => 'required|integer|min:0|lte:total_quantity',
        ]);

        $part->update($request->all());

        return redirect()->route('parts.show', $part)->with('success', 'Part updated successfully.');
    }

    /**
     * Remove the specified part from storage.
     */
    public function destroy(Part $part)
    {
        $part->delete();
        return redirect()->route('parts.index')->with('success', 'Part deleted successfully.');
    }

    // --- Part Usage History Methods (can be in a separate controller for larger apps) ---

    /**
     * Show the form for recording part usage.
     */
    public function createUsage(Part $part)
    {
        $teams = Team::all();
        $sites = Site::all();
        $projects = Project::all();
        return view('part_usage.create', compact('part', 'teams', 'sites', 'projects'));
    }

    /**
     * Store a new part usage record.
     */
    public function storeUsage(Request $request, Part $part)
    {
        $request->validate([
            'used_by_team_id' => 'required|exists:teams,id',
            'site_id' => 'required|exists:sites,id',
            'project_id' => 'nullable|exists:projects,id',
            'date_used' => 'required|date',
            'returned' => 'boolean',
            'condition_after_use' => 'nullable|string|max:255',
            'purpose_note' => 'nullable|string',
        ]);

        $part->usageHistory()->create($request->all());

        // Decrement current_stock if the part is being used and not returned immediately
        if (!$request->input('returned')) {
            $part->decrement('current_stock');
        }

        return redirect()->route('parts.show', $part)->with('success', 'Part usage recorded successfully.');
    }
}