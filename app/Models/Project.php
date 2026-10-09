<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'client',
        'problem',
        'solution',
        'result',
        'technologies',
        'live_url',
        'year',
        'image_class',
        'image_path',
        'is_tall',
        'is_wide',
        'order',
        'is_featured',
    ];

    /**
     * Use slug as the route key so /portfolio/{project} resolves by slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Auto-generate a unique slug from title when one is not supplied.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = static::uniqueSlug($project->title);
            }
        });

        static::updating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = static::uniqueSlug($project->title, $project->id);
            }
        });
    }

    /**
     * Generate a slug that is unique in the projects table.
     * If $base-slug is taken, appends -2, -3, etc.
     */
    public static function uniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 2;

        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $base . '-' . $counter++;
            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }
}
