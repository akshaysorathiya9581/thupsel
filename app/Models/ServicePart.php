<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePart extends Model
{
    use HasFactory;
    protected $fillable=[
        'cat_id',
        'title',
        'sku',
        'unit',
        'price',
        'description',
        'type',
        'parent_id',
    ];

    public function serviceTasks()
    {
        return $this->hasMany('App\Models\ServiceTask','service_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

}
