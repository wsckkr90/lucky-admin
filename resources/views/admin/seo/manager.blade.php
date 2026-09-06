@extends('layouts.admin')

@section('title', 'SEO Manager / SEO प्रबंधक')

@section('content')
@php
    $page = $selectedPage;
    $seoScore = 0;
    if ($page) {
        $seoScore = collect([
            $page->meta_title,
            $page->meta_description,
            $page->canonical_url,
            $page->robots,
            $page->og_title,
            $page->og_description,
            $page->schema_type,
        ])->filter(fn($v) => filled($v))->count();
        $seoScore = min(100, (int) round(($seoScore / 7) * 100));
    }
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <div class="text-uppercase small text-muted fw-semibold">SEO / सर्च इंजन</div>
        <h2 class="mb-1">Manage SEO / SEO प्रबंधित करें</h2>
        <p class="text-muted mb-0">Website चुनें → Public Page चुनें → SEO भरें → Save करें.</p>
    </div>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#addWebsite">
        + Add Website / वेबसाइट जोड़ें
    </button>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif

<div class="collapse mb-4" id="addWebsite">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Add Website / नई वेबसाइट</h5>
            <form method="POST" action="{{ route('admin.seo.sites.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Website Name / वेबसाइट नाम</label><input class="form-control" name="name" placeholder="Lucky Satta" required></div>
                    <div class="col-md-6"><label class="form-label">Domain / डोमेन</label><input class="form-control" name="domain" placeholder="example.com" required></div>
                    <div class="col-md-3"><label class="form-label">Protocol</label><select class="form-select" name="scheme"><option value="https">HTTPS</option><option value="http">HTTP</option></select></div>
                    <div class="col-md-9"><label class="form-label">Logo URL / लोगो</label><input class="form-control" type="url" name="logo_url" placeholder="https://example.com/logo.png"></div>
                    <div class="col-md-6"><label class="form-label">Organization Name / संस्था नाम</label><input class="form-control" name="organization_name" placeholder="Lucky Satta"></div>
                    <div class="col-md-6"><label class="form-label">Social profile URLs (one per line) / सोशल लिंक</label><textarea class="form-control" name="same_as" rows="3" placeholder="https://facebook.com/...&#10;https://instagram.com/... "></textarea></div>
                </div>
                <button class="btn btn-success mt-3">Save Website / वेबसाइट सेव करें</button>
            </form>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-lg-6">
                <label class="form-label fw-semibold">Select Website / वेबसाइट चुनें</label>
                <select class="form-select form-select-lg" id="seoSiteSelect">
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}" @selected($site->id == $selectedSite->id)>{{ $site->name }} ({{ $site->domain }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6">
                <label class="form-label fw-semibold">Select Public Page / पब्लिक पेज चुनें</label>
                <select class="form-select form-select-lg" id="seoPageSelect">
                    @foreach($selectedSite->pages as $sitePage)
                        <option value="{{ $sitePage->id }}" @selected($page && $sitePage->id == $page->id)>{{ $sitePage->label }} — {{ $sitePage->path }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="small text-muted mt-3">Domain और page path automatically match होंगे, इसलिए हर website के लिए अलग SEO सेट रख सकते हैं.</div>
    </div>
</div>

@if($page)
<form method="POST" action="{{ route('admin.seo.pages.save', $page) }}">
@csrf
@method('PUT')
<div class="row g-4">
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4"><h5 class="mb-0">Basic SEO / मुख्य SEO</h5></div>
            <div class="card-body px-4">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label">Page Name / पेज नाम</label><input class="form-control" name="label" value="{{ old('label',$page->label) }}" required></div>
                    <div class="col-md-6"><label class="form-label">URL Path / URL</label><input class="form-control" name="path" value="{{ old('path',$page->path) }}" required></div>
                    <div class="col-md-6"><label class="form-label">Robots / रोबोट</label><select class="form-select" name="robots"><option value="index,follow">Index + Follow</option><option value="noindex,follow" @selected($page->robots==='noindex,follow')>No Index + Follow</option><option value="index,nofollow" @selected($page->robots==='index,nofollow')>Index + No Follow</option><option value="noindex,nofollow" @selected($page->robots==='noindex,nofollow')>No Index + No Follow</option></select></div>
                    <div class="col-12"><label class="form-label">Meta Title / मेटा टाइटल</label><input class="form-control" maxlength="255" name="meta_title" value="{{ old('meta_title',$page->meta_title) }}" placeholder="Lucky Satta Result Today | Official Results"></div>
                    <div class="col-12"><label class="form-label">Meta Description / मेटा डिस्क्रिप्शन</label><textarea class="form-control" maxlength="1000" rows="4" name="meta_description" placeholder="Page के बारे में साफ और उपयोगी description लिखें.">{{ old('meta_description',$page->meta_description) }}</textarea></div>
                    <div class="col-md-6"><label class="form-label">Focus Keyword / मुख्य कीवर्ड</label><input class="form-control" name="focus_keyword" value="{{ old('focus_keyword',$page->focus_keyword) }}"></div>
                    <div class="col-md-6"><label class="form-label">Secondary Keywords / अतिरिक्त कीवर्ड</label><input class="form-control" name="secondary_keywords" value="{{ old('secondary_keywords',$page->secondary_keywords) }}" placeholder="result, chart, today result"></div>
                    <div class="col-md-8"><label class="form-label">Canonical URL / मुख्य URL</label><input type="url" class="form-control" name="canonical_url" value="{{ old('canonical_url',$page->canonical_url) }}"></div>
                    <div class="col-md-4"><label class="form-label">Author / लेखक</label><input class="form-control" name="author" value="{{ old('author',$page->author) }}"></div>
                    <div class="col-md-6"><label class="form-label">Publish Date & Time / तारीख व समय</label><input type="datetime-local" class="form-control" name="published_at" value="{{ old('published_at',$page->published_at?->format('Y-m-d\\TH:i')) }}"></div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4"><h5 class="mb-0">Google & Social / सोशल शेयर</h5></div>
            <div class="card-body px-4"><div class="row g-3">
                <div class="col-md-6"><label class="form-label">OG Title</label><input class="form-control" name="og_title" value="{{ old('og_title',$page->og_title) }}"></div>
                <div class="col-md-6"><label class="form-label">OG Image URL</label><input type="url" class="form-control" name="og_image" value="{{ old('og_image',$page->og_image) }}"></div>
                <div class="col-12"><label class="form-label">OG Description</label><textarea class="form-control" rows="3" name="og_description">{{ old('og_description',$page->og_description) }}</textarea></div>
                <div class="col-md-6"><label class="form-label">Twitter/X Title</label><input class="form-control" name="twitter_title" value="{{ old('twitter_title',$page->twitter_title) }}"></div>
                <div class="col-md-6"><label class="form-label">Twitter/X Image URL</label><input type="url" class="form-control" name="twitter_image" value="{{ old('twitter_image',$page->twitter_image) }}"></div>
                <div class="col-12"><label class="form-label">Twitter/X Description</label><textarea class="form-control" rows="3" name="twitter_description">{{ old('twitter_description',$page->twitter_description) }}</textarea></div>
            </div></div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4"><h5 class="mb-0">Structured Data / Schema</h5></div>
            <div class="card-body px-4"><div class="row g-3">
                <div class="col-md-4"><label class="form-label">Schema Type</label><select class="form-select" name="schema_type"><option>WebPage</option><option @selected($page->schema_type==='WebSite')>WebSite</option><option @selected($page->schema_type==='Article')>Article</option><option @selected($page->schema_type==='Organization')>Organization</option></select></div>
                <div class="col-md-8"><label class="form-label">Schema JSON-LD (advanced)</label><textarea class="form-control font-monospace" rows="7" name="schema_json" placeholder='{"@context":"https://schema.org","@type":"WebPage"}'>{{ old('schema_json',$page->schema_json ? json_encode($page->schema_json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) : '') }}</textarea></div>
                <div class="col-12"><label class="form-label">Extra Head Tags / अतिरिक्त Head Code</label><textarea class="form-control font-monospace" rows="6" name="extra_head" placeholder="Additional verification tags, custom meta, etc.">{{ old('extra_head',$page->extra_head) }}</textarea><div class="form-text">Only trusted admin HTML/meta code रखें.</div></div>
            </div></div>
        </div>

        <button class="btn btn-primary btn-lg px-4">Save SEO / SEO सेव करें</button>
    </div>

    <div class="col-xl-4">
        <div class="card border-0 shadow-sm mb-4 position-sticky" style="top:1rem">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3"><strong>SEO Health / SEO स्थिति</strong><span class="badge text-bg-{{ $seoScore >= 80 ? 'success' : ($seoScore >= 50 ? 'warning' : 'danger') }}">{{ $seoScore }}%</span></div>
                <div class="progress mb-3" style="height:10px"><div class="progress-bar" style="width:{{ $seoScore }}%"></div></div>
                <p class="small text-muted">Basic fields भरने के बाद score बढ़ेगा. Final ranking guarantee नहीं है.</p>
                <hr>
                <div class="small">
                    <div class="mb-2">✓ Meta title / मेटा टाइटल</div>
                    <div class="mb-2">✓ Description / विवरण</div>
                    <div class="mb-2">✓ Canonical / कैनोनिकल</div>
                    <div class="mb-2">✓ Robots / रोबोट</div>
                    <div class="mb-2">✓ Social preview / सोशल</div>
                    <div>✓ Schema / स्ट्रक्चर्ड डेटा</div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endif

<script>
const sites = @json($sites->mapWithKeys(fn($s) => [$s->id => $s->pages->map(fn($p) => ['id'=>$p->id,'label'=>$p->label,'path'=>$p->path])]));
const siteSelect = document.getElementById('seoSiteSelect');
const pageSelect = document.getElementById('seoPageSelect');
function syncSeoSelectors() {
    const pages = sites[siteSelect.value] || [];
    pageSelect.innerHTML = pages.map(p => `<option value="${p.id}">${p.label} — ${p.path}</option>`).join('');
    const url = new URL(window.location.href);
    url.searchParams.set('site', siteSelect.value);
    if (pages[0]) url.searchParams.set('page', pages[0].id);
    window.location.href = url.toString();
}
siteSelect?.addEventListener('change', syncSeoSelectors);
pageSelect?.addEventListener('change', () => {
    const url = new URL(window.location.href);
    url.searchParams.set('site', siteSelect.value);
    url.searchParams.set('page', pageSelect.value);
    window.location.href = url.toString();
});
</script>
@endsection
