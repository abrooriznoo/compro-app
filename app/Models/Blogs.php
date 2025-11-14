<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'status',
        'writer',
        'photos',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
