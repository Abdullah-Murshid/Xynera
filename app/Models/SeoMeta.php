<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_metas';

    protected $fillable = [
        'page_name',
        'title',
        'meta_description',
        'keywords',
        'og_image',
        'og_description',
        'twitter_card',
        'canonical_url',
    ];

    /**
     * Fetch SEO meta by page slug/name.
     * Usage: SeoMeta::getBySlug('home')
     */
    public static function getBySlug(string $slug): ?self
    {
        return static::where('page_name', $slug)->first();
    }

    /**
     * Get existing SEO meta or create a new one with sensible defaults.
     * Usage: SeoMeta::getOrCreateDefault('home', 'Xynera — Home', 'We build...')
     */
    public static function getOrCreateDefault(string $slug, string $title = '', string $description = ''): self
    {
        return static::firstOrCreate(
            ['page_name' => $slug],
            [
                'title'            => $title,
                'meta_description' => $description,
                'twitter_card'     => 'summary_large_image',
            ]
        );
    }

    /**
     * Get the full public URL for the OG image.
     */
    public function getOgImageUrlAttribute(): ?string
    {
        if (!$this->og_image) {
            return null;
        }
        return asset('storage/' . $this->og_image);
    }
}
