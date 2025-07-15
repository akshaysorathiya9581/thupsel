<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'site_id',
    ];

    /**
     * Get the site that owns the project.
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * Get the part usage history associated with the project.
     */
    public function partUsageHistory()
    {
        return $this->hasMany(PartUsageHistory::class);
    }
}