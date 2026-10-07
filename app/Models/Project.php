<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'year',
        'image_class',
        'image_path',
        'is_tall',
        'is_wide',
        'order',
        'is_featured',
    ];
}
