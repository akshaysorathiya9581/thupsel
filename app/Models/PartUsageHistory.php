<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartUsageHistory extends Model
{
    use HasFactory;

    protected $table = 'part_usage_histories'; // Specify table name if it doesn't follow convention

    protected $fillable = [
        'part_id',
        'used_by_team_id',
        'site_id',
        'project_id',
        'date_used',
        'returned',
        'condition_after_use',
        'purpose_note',
    ];

    protected $casts = [
        'date_used' => 'datetime',
        'returned' => 'boolean',
    ];

    /**
     * Get the part that this history record belongs to.
     */
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    /**
     * Get the team that used the part.
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'used_by_team_id');
    }

    /**
     * Get the site where the part was used.
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * Get the project where the part was used.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}