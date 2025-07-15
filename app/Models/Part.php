<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'purchase_date',
        'supplier',
        'status',
        'serial_number',
        'total_quantity',
        'current_stock',
    ];

    /**
     * Get the usage history for the part.
     */
    public function usageHistory()
    {
        return $this->hasMany(PartUsageHistory::class);
    }

    /**
     * Get the teams currently assigned this part (conceptually, derived from history).
     * This would typically be a more complex query or a separate 'assignments' table.
     * For simplicity, we'll fetch recent usage history.
     */
    public function currentAssignments()
    {
        // This is a simplified approach. In a real app, you might have an 'assignments' table
        // or more sophisticated logic to determine "currently assigned".
        return $this->usageHistory()
                    ->where('returned', false)
                    ->with('team', 'site')
                    ->latest('date_used')
                    ->get()
                    ->unique('used_by_team_id'); // Get unique assignments by team
    }

    /**
     * Calculate total parts used.
     */
    public function getTotalUsedAttribute()
    {
        return $this->usageHistory()->count();
    }
}