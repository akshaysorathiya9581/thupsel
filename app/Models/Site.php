<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * Get the projects associated with the site.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the part usage history associated with the site.
     */
    public function partUsageHistory()
    {
        return $this->hasMany(PartUsageHistory::class);
    }
}