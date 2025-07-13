<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientCategory extends Model
{

    protected $table = 'client_categories';

    protected $fillable = [
        'cat_id',
        'user_id',
        'type'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
