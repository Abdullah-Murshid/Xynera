<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates the seo_metas table for managing per-page SEO metadata.
     * Each page is identified by a unique slug (e.g. 'home', 'about', 'services/web-design').
     */
    public function up(): void
    {
        Schema::create('seo_metas', function (Blueprint $table) {
            $table->id();

            // The unique page identifier — used to look up SEO data per page
            // e.g. 'home', 'services', 'portfolio', 'contact'
            $table->string('page_name')->unique();  // kept as page_name for backward compatibility

            // Core SEO fields
            $table->string('title', 60)->nullable();           // Recommended max 60 chars for Google
            $table->text('meta_description')->nullable();      // Recommended max 160 chars
            $table->string('keywords')->nullable();            // Comma-separated keywords (lower priority for modern SEO)

            // Open Graph (for Facebook, LinkedIn, WhatsApp shares)
            $table->string('og_image')->nullable();            // Stored as relative path in storage/
            $table->text('og_description')->nullable();        // Can differ from meta_description

            // Twitter Card
            $table->string('twitter_card', 30)->default('summary_large_image'); // 'summary' or 'summary_large_image'

            // Canonical URL — prevents duplicate content penalties
            $table->string('canonical_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_metas');
    }
};
