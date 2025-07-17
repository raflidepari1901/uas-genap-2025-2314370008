<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $table = 'articles'; 
    protected $casts = [
        'published_at' => 'datetime',
    ];


    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'is_publish',
        'published_at',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
