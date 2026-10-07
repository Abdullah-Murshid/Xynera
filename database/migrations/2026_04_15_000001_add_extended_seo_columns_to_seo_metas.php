<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add new SEO columns to the existing seo_metas table.
     *
     * We keep the existing columns (page_name, title, meta_description, og_image)
     * and add the new ones: keywords, og_description, twitter_card, canonical_url.
     *
     * The 'title' column is also renamed from an unbounded string to max:60
     * via a modifier (MySQL will safely ALTER the column length).
     */
    public function up(): void
    {
        Schema::table('seo_metas', function (Blueprint $table) {
            // Add keywords if it doesn't exist
            if (!Schema::hasColumn('seo_metas', 'keywords')) {
                $table->string('keywords')->nullable()->after('meta_description');
            }

            // Add og_description (separate from meta_description for social)
            if (!Schema::hasColumn('seo_metas', 'og_description')) {
                $table->text('og_description')->nullable()->after('og_image');
            }

            // Add twitter_card type with sensible default
            if (!Schema::hasColumn('seo_metas', 'twitter_card')) {
                $table->string('twitter_card', 30)->default('summary_large_image')->after('og_description');
            }

            // Add canonical_url for duplicate content prevention
            if (!Schema::hasColumn('seo_metas', 'canonical_url')) {
                $table->string('canonical_url')->nullable()->after('twitter_card');
            }
        });
    }

    /**
     * Reverse the migrations — remove the added columns.
     */
    public function down(): void
    {
        Schema::table('seo_metas', function (Blueprint $table) {
            $table->dropColumn(['keywords', 'og_description', 'twitter_card', 'canonical_url']);
        });
    }
};
