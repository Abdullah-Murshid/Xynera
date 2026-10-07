@extends('layouts.admin')

@section('title', 'SEO Manager')
@section('header_title', 'SEO Meta Manager')

@section('content')

{{-- ── Page Cards Grid ─────────────────────────────────────────────── --}}
<div class="service-grid" style="margin-bottom: 2rem;">
    @foreach($pages as $key => $pageTitle)
    @php $seo = $seos[$key] ?? null; @endphp
    <div class="service-card">
        <div class="service-header">
            <div class="service-icon">
                <span class="material-symbols-outlined">language</span>
            </div>
            <span class="status {{ $seo ? 'live' : '' }}">
                <span class="dot"></span>
                {{ $seo ? 'Customized' : 'Default' }}
            </span>
        </div>
        <div class="service-body">
            <h3>{{ $pageTitle }}</h3>
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.35rem;">
                <code style="background: rgba(150,150,150,0.1); padding: 2px 6px; border-radius: 4px;">{{ $key }}</code>
            </div>
            <div style="font-size: 0.85rem; margin-bottom: 0.4rem;">
                <strong>Title:</strong>
                <span style="color: var(--text-muted);">{{ $seo->title ?? '— not set —' }}</span>
            </div>
            <p style="font-size:0.82rem;">{{ Str::limit($seo->meta_description ?? 'No description set.', 90) }}</p>

            {{-- Show extra fields if they exist --}}
            @if($seo && ($seo->keywords || $seo->twitter_card || $seo->canonical_url))
            <div style="margin-top: 0.5rem; display: flex; flex-wrap: wrap; gap: 0.4rem;">
                @if($seo->keywords)
                <span class="badge" style="background:rgba(59,130,246,0.1);color:#3b82f6;">Keywords</span>
                @endif
                @if($seo->og_image)
                <span class="badge" style="background:rgba(168,85,247,0.1);color:#a855f7;">OG Image</span>
                @endif
                @if($seo->canonical_url)
                <span class="badge" style="background:rgba(16,185,129,0.1);color:#10b981;">Canonical</span>
                @endif
                <span class="badge" style="background:rgba(245,158,11,0.1);color:#f59e0b;">{{ $seo->twitter_card ?? 'summary_large_image' }}</span>
            </div>
            @endif
        </div>
        <div class="service-footer">
            {{-- Reset button (only shown if record exists) --}}
            @if($seo)
            <form action="{{ route('admin.seo.destroy', $seo->id) }}" method="POST"
                  onsubmit="return confirm('Reset SEO for {{ $pageTitle }} to defaults?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" title="Reset to defaults">
                    <span class="material-symbols-outlined">restart_alt</span>
                </button>
            </form>
            @endif

            {{-- Edit button --}}
            <button class="action-btn" title="Edit SEO"
                    onclick="openSeoModal(
                        '{{ $key }}',
                        '{{ addslashes($seo?->title ?? '') }}',
                        '{{ addslashes($seo?->meta_description ?? '') }}',
                        '{{ addslashes($seo?->keywords ?? '') }}',
                        '{{ $seo?->og_image ? asset('storage/' . $seo->og_image) : '' }}',
                        '{{ addslashes($seo?->og_description ?? '') }}',
                        '{{ $seo?->twitter_card ?? 'summary_large_image' }}',
                        '{{ addslashes($seo?->canonical_url ?? '') }}'
                    )">
                <span class="material-symbols-outlined">edit</span> Edit Meta
            </button>
        </div>
    </div>
    @endforeach
</div>

{{-- ── SEO Tips Card ────────────────────────────────────────────────── --}}
<div class="table-container" style="padding: 1.5rem;">
    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
        <span class="material-symbols-outlined" style="color: var(--accent);">tips_and_updates</span>
        <h3 style="font-size: 1rem; font-weight: 700;">SEO Best Practices</h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
        @foreach([
            ['Title', '50–60 characters for Google to display fully without truncation.', 'title'],
            ['Description', '120–160 characters. Write for humans — it affects CTR but not ranking.', 'description'],
            ['Keywords', 'Low modern impact, but keep them focused and relevant.', 'key'],
            ['OG Image', '1200×630px recommended. Used when shared on social media.', 'image'],
            ['Canonical', 'Prevents duplicate content if the page is accessible via multiple URLs.', 'link'],
            ['Twitter Card', 'summary_large_image shows a big preview — best for visual engagement.', 'twitter'],
        ] as [$label, $tip, $icon])
        <div style="background: rgba(150,150,150,0.05); border-radius: 8px; padding: 1rem; border: 1px solid var(--border);">
            <strong style="font-size: 0.8rem; display: block; margin-bottom: 0.3rem; color: var(--accent);">{{ $label }}</strong>
            <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5; margin: 0;">{{ $tip }}</p>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('modals')
{{-- ═══════════════════════ SEO EDIT MODAL ════════════════════════════ --}}
<div id="seoModal" class="modal-overlay">
    <div class="modal-container" style="max-width: 640px;">

        {{-- Header --}}
        <div class="modal-header">
            <div>
                <h2 id="seoModalTitle">Edit SEO Meta</h2>
                <p id="seoModalSubtitle" style="font-size:0.8rem; color:var(--text-muted); margin-top:2px;"></p>
            </div>
            <button class="close-btn" id="closeSeoModalBtn" type="button">&times;</button>
        </div>

        {{-- Form --}}
        <form id="seoForm" action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="page_name" id="seoPageName">

            {{-- ── Core SEO ──────────────────────────────────────────── --}}
            <div style="padding: 0 28px; margin-top: 1.25rem;">
                <p style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--accent); margin-bottom:1rem;">
                    Core SEO
                </p>

                {{-- Page Title --}}
                <div class="form-group full-width" style="margin-bottom: 1rem;">
                    <label for="seoTitle">
                        Page Title
                        <span id="titleCounter" style="float:right; font-weight:400; color:var(--text-muted);">0 / 60</span>
                    </label>
                    <input type="text" name="title" id="seoTitle"
                           placeholder="e.g. Premium Web Design Agency — Xynera"
                           maxlength="60">
                    <span class="form-hint" id="titleHint">Keep under 60 chars so Google doesn't truncate it in search results.</span>
                </div>

                {{-- Meta Description --}}
                <div class="form-group full-width" style="margin-bottom: 1rem;">
                    <label for="seoDescription">
                        Meta Description
                        <span id="descCounter" style="float:right; font-weight:400; color:var(--text-muted);">0 / 160</span>
                    </label>
                    <textarea name="meta_description" id="seoDescription" rows="3"
                              placeholder="A compelling summary shown in Google search results..."
                              maxlength="160"></textarea>
                    <span class="form-hint" id="descHint">120–160 chars. Affects click-through rate — write for humans, not bots.</span>
                </div>

                {{-- Keywords --}}
                <div class="form-group full-width" style="margin-bottom: 1rem;">
                    <label for="seoKeywords">Keywords <small style="font-weight:400;">(optional)</small></label>
                    <input type="text" name="keywords" id="seoKeywords"
                           placeholder="web design, SEO, digital agency">
                    <span class="form-hint">Comma-separated. Low modern SEO impact, but harmless to include.</span>
                </div>

                {{-- Canonical URL --}}
                <div class="form-group full-width" style="margin-bottom: 0;">
                    <label for="seoCanonical">Canonical URL <small style="font-weight:400;">(optional)</small></label>
                    <input type="url" name="canonical_url" id="seoCanonical"
                           placeholder="https://xynera.com/services">
                    <span class="form-hint">Set this if the page is accessible via multiple URLs to avoid duplicate content.</span>
                </div>
            </div>

            <div style="height:1px; background:var(--border); margin: 1.25rem 0;"></div>

            {{-- ── Open Graph ────────────────────────────────────────── --}}
            <div style="padding: 0 28px;">
                <p style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--accent); margin-bottom:1rem;">
                    Open Graph <small style="font-weight:400; text-transform:none; letter-spacing:0;">(Facebook, LinkedIn, WhatsApp)</small>
                </p>

                {{-- OG Image Upload --}}
                <div class="form-group full-width" style="margin-bottom: 1rem;">
                    <label>OG Image <small style="font-weight:400;">(1200×630px recommended)</small></label>
                    <div class="upload-zone" id="ogUploadZone">
                        <input type="file" name="og_image" id="ogImageInput"
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               onchange="previewOgImage(this)">
                        <span class="material-symbols-outlined">add_photo_alternate</span>
                        <span class="label" id="ogUploadLabel">Click or drag to upload OG image</span>
                        <p>JPEG, PNG, WEBP — Max 2MB</p>
                    </div>
                    {{-- Image preview --}}
                    <div id="ogImagePreviewWrap" style="display:none; margin-top:0.75rem; position:relative;">
                        <img id="ogImagePreview" src="" alt="OG Image Preview"
                             style="width:100%; max-height:180px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                        <button type="button" onclick="removeOgImage()"
                                style="position:absolute; top:8px; right:8px; background:rgba(239,68,68,0.9); color:white;
                                       border-radius:50%; width:28px; height:28px; display:flex; align-items:center;
                                       justify-content:center; font-size:1rem; line-height:1; cursor:pointer;">
                            &times;
                        </button>
                    </div>
                    <input type="hidden" name="remove_og_image" id="removeOgImage" value="0">
                </div>

                {{-- OG Description --}}
                <div class="form-group full-width" style="margin-bottom: 0;">
                    <label for="seoOgDescription">
                        OG Description <small style="font-weight:400;">(optional — can differ from meta description)</small>
                    </label>
                    <textarea name="og_description" id="seoOgDescription" rows="2"
                              placeholder="Description shown when this page is shared on social media..."></textarea>
                </div>
            </div>

            <div style="height:1px; background:var(--border); margin: 1.25rem 0;"></div>

            {{-- ── Twitter Card ──────────────────────────────────────── --}}
            <div style="padding: 0 28px; margin-bottom: 1.25rem;">
                <p style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--accent); margin-bottom:1rem;">
                    Twitter Card
                </p>

                <div class="form-group full-width">
                    <label for="seoTwitterCard">Card Type</label>
                    <select name="twitter_card" id="seoTwitterCard" style="width:100%; padding:0.6rem 0.75rem; background:rgba(150,150,150,0.05); border:1px solid var(--border); color:var(--text); border-radius:6px; font-family:inherit;">
                        <option value="summary_large_image">summary_large_image — Large image preview (recommended)</option>
                        <option value="summary">summary — Small square thumbnail</option>
                    </select>
                    <span class="form-hint">summary_large_image gives much better engagement on Twitter / X.</span>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn-secondary" id="cancelSeoModalBtn">Cancel</button>
                <button type="submit" class="btn-primary" id="saveSeoBtn">
                    <span class="material-symbols-outlined" style="font-size:1rem;">save</span>
                    Save SEO
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* ── SEO index-specific styles ───────────── */
.form-hint {
    display: block;
    font-size: 0.73rem;
    color: var(--text-muted);
    margin-top: 0.25rem;
    line-height: 1.4;
}
.form-hint.warning { color: #fb923c; }
.form-hint.danger  { color: #ef4444; }

/* Counter badge inside label */
#titleCounter, #descCounter {
    font-size: 0.7rem;
    transition: color 0.2s;
}
</style>
@endsection

@push('scripts')
<script>
// ── Modal state ───────────────────────────────────────────────────────────
const seoModal        = document.getElementById('seoModal');
const seoForm         = document.getElementById('seoForm');
const seoTitleInput   = document.getElementById('seoTitle');
const seoDescInput    = document.getElementById('seoDescription');
const titleCounter    = document.getElementById('titleCounter');
const descCounter     = document.getElementById('descCounter');
const titleHint       = document.getElementById('titleHint');
const descHint        = document.getElementById('descHint');

// ── Character counters ────────────────────────────────────────────────────
function updateCounters() {
    const tLen = seoTitleInput.value.length;
    const dLen = seoDescInput.value.length;

    titleCounter.textContent = `${tLen} / 60`;
    titleCounter.style.color = tLen > 55 ? (tLen > 60 ? '#ef4444' : '#fb923c') : 'var(--text-muted)';
    titleHint.className      = tLen > 60 ? 'form-hint danger' : (tLen > 55 ? 'form-hint warning' : 'form-hint');

    descCounter.textContent  = `${dLen} / 160`;
    descCounter.style.color  = dLen > 145 ? (dLen > 160 ? '#ef4444' : '#fb923c') : 'var(--text-muted)';
    descHint.className       = dLen > 160 ? 'form-hint danger' : (dLen > 145 ? 'form-hint warning' : 'form-hint');
}

seoTitleInput.addEventListener('input', updateCounters);
seoDescInput.addEventListener('input', updateCounters);

// ── OG Image preview ─────────────────────────────────────────────────────
function previewOgImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('ogImagePreview').src = e.target.result;
            document.getElementById('ogImagePreviewWrap').style.display = 'block';
            document.getElementById('ogUploadLabel').textContent = input.files[0].name;
            document.getElementById('removeOgImage').value = '0';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeOgImage() {
    document.getElementById('ogImageInput').value = '';
    document.getElementById('ogImagePreviewWrap').style.display = 'none';
    document.getElementById('ogImagePreview').src = '';
    document.getElementById('ogUploadLabel').textContent = 'Click or drag to upload OG image';
    document.getElementById('removeOgImage').value = '1';
}

// ── Open modal pre-filled with page's existing data ───────────────────────
function openSeoModal(pageName, title, desc, keywords, ogImageUrl, ogDesc, twitterCard, canonical) {
    // Set hidden page name
    document.getElementById('seoPageName').value   = pageName;

    // Update modal heading
    document.getElementById('seoModalTitle').textContent    = 'Edit SEO — ' + pageName.charAt(0).toUpperCase() + pageName.slice(1);
    document.getElementById('seoModalSubtitle').textContent = 'route: /' + pageName;

    // Fill text fields
    seoTitleInput.value                                = title;
    seoDescInput.value                                 = desc;
    document.getElementById('seoKeywords').value      = keywords;
    document.getElementById('seoOgDescription').value = ogDesc;
    document.getElementById('seoCanonical').value     = canonical;

    // Twitter card dropdown
    document.getElementById('seoTwitterCard').value = twitterCard || 'summary_large_image';

    // OG image preview (if existing image URL was passed)
    document.getElementById('removeOgImage').value = '0';
    if (ogImageUrl && ogImageUrl !== '') {
        document.getElementById('ogImagePreview').src          = ogImageUrl;
        document.getElementById('ogImagePreviewWrap').style.display = 'block';
        document.getElementById('ogUploadLabel').textContent   = 'Current image shown above';
    } else {
        document.getElementById('ogImagePreviewWrap').style.display = 'none';
        document.getElementById('ogImagePreview').src          = '';
        document.getElementById('ogUploadLabel').textContent   = 'Click or drag to upload OG image';
    }

    updateCounters();
    seoModal.classList.add('active');
}

// ── Modal close helpers ───────────────────────────────────────────────────
function closeSeoModal() { seoModal.classList.remove('active'); }

document.getElementById('closeSeoModalBtn').addEventListener('click', closeSeoModal);
document.getElementById('cancelSeoModalBtn').addEventListener('click', closeSeoModal);
seoModal.addEventListener('click', e => { if (e.target === seoModal) closeSeoModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSeoModal(); });
</script>
@endpush
