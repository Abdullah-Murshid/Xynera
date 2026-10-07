<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SeoMeta;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SeoController extends Controller
{
    /**
     * All pages managed by the SEO system.
     * Key = page_name stored in DB, Value = human-readable label shown in admin.
     */
    private array $pages = [
        'home'      => 'Home Page',
        'services'  => 'Services Page',
        'portfolio' => 'Portfolio Page',
        'contact'   => 'Contact Page',
    ];

    /**
     * Display the SEO management index page.
     * Lists all managed pages with their current SEO status.
     */
    public function index(): View
    {
        // Key SEO records by page_name for easy lookup in the view
        $seos = SeoMeta::all()->keyBy('page_name');

        return view('admin.seo.index', [
            'seos'  => $seos,
            'pages' => $this->pages,
        ]);
    }

    /**
     * Update (or create) the SEO meta for a given page.
     * Handles text fields + optional OG image upload.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_name'        => 'required|string|in:' . implode(',', array_keys($this->pages)),
            'title'            => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'keywords'         => 'nullable|string|max:255',
            'og_image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
            'og_description'   => 'nullable|string|max:300',
            'twitter_card'     => 'nullable|string|in:summary,summary_large_image',
            'canonical_url'    => 'nullable|url|max:500',
            'remove_og_image'  => 'nullable|boolean',
        ]);

        // Find existing record or start fresh
        $seoMeta = SeoMeta::firstOrNew(['page_name' => $validated['page_name']]);

        // ── Handle OG Image upload ──────────────────────────────────────────
        if ($request->hasFile('og_image')) {
            // Delete old image from storage if it exists
            if ($seoMeta->og_image && Storage::disk('public')->exists($seoMeta->og_image)) {
                Storage::disk('public')->delete($seoMeta->og_image);
            }
            // Store new image in storage/app/public/seo/
            $path = $request->file('og_image')->store('seo', 'public');
            $seoMeta->og_image = $path;
        }

        // ── Handle explicit image removal ───────────────────────────────────
        if ($request->boolean('remove_og_image') && $seoMeta->og_image) {
            if (Storage::disk('public')->exists($seoMeta->og_image)) {
                Storage::disk('public')->delete($seoMeta->og_image);
            }
            $seoMeta->og_image = null;
        }

        // ── Fill remaining fields ───────────────────────────────────────────
        $seoMeta->title            = $validated['title'] ?? null;
        $seoMeta->meta_description = $validated['meta_description'] ?? null;
        $seoMeta->keywords         = $validated['keywords'] ?? null;
        $seoMeta->og_description   = $validated['og_description'] ?? null;
        $seoMeta->twitter_card     = $validated['twitter_card'] ?? 'summary_large_image';
        $seoMeta->canonical_url    = $validated['canonical_url'] ?? null;

        $seoMeta->save();

        notify('SEO settings for "' . $this->pages[$validated['page_name']] . '" updated successfully!');
        return redirect()->route('admin.seo');
    }

    /**
     * Delete a SEO meta record and clean up its OG image.
     */
    public function destroy(SeoMeta $seoMeta): RedirectResponse
    {
        // Clean up OG image from storage
        if ($seoMeta->og_image && Storage::disk('public')->exists($seoMeta->og_image)) {
            Storage::disk('public')->delete($seoMeta->og_image);
        }

        $seoMeta->delete();

        notify('SEO settings reset to defaults.', 'info');
        return redirect()->route('admin.seo');
    }
}
