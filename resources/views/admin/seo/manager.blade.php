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
            $page->focus_keyword,
            $page->canonical_url,
            $page->robots,
            $page->og_title,
            $page->og_image,
            $page->schema_type,
        ])->filter(fn ($value) => filled($value))->count();
        $seoScore = min(100, (int) round(($seoScore / 8) * 100));
    }
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <div class="text-uppercase small text-muted fw-bold">Search Engine Optimization / सर्च इंजन ऑप्टिमाइज़ेशन</div>
        <h2 class="mb-1">SEO Manager / SEO प्रबंधक</h2>
        <p class="text-muted mb-0">1. Website चुनें → 2. Public Page चुनें → 3. SEO भरें → 4. Save करें</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary" type="button" data-collapse-toggle="seoHowTo" aria-expanded="false" aria-controls="seoHowTo">ⓘ How to use / कैसे चलाएँ</button>
        <button class="btn btn-primary" type="button" data-collapse-toggle="addWebsite" aria-expanded="false" aria-controls="addWebsite">＋ Add Website / वेबसाइट जोड़ें</button>
    </div>
</div>

@if(session('success')) <div class="admin-alert admin-alert-success">{{ session('success') }}</div> @endif
@if($errors->any()) <div class="admin-alert admin-alert-danger">{{ $errors->first() }}</div> @endif

<div class="collapse hidden mb-4" id="seoHowTo">
    <div class="card border-primary">
        <div class="card-header p-4">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div>
                    <h5 class="mb-1">SEO Manager Guide / SEO Manager उपयोग गाइड</h5>
                    <div class="small text-muted">हर website और उसके public pages का SEO अलग-अलग manage करने का सही workflow.</div>
                </div>
                <span class="badge text-bg-primary">Admin Help</span>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h6 class="fw-bold">1. Website setup / वेबसाइट सेट करें</h6>
                    <p class="small text-muted mb-2">सबसे पहले <strong>Add Website</strong> खोलें और website name, domain तथा protocol भरें। Logo और social profile URLs optional हैं, लेकिन Organization/brand data सही रखना बेहतर है.</p>
                    <h6 class="fw-bold mt-3">2. Website चुनें</h6>
                    <p class="small text-muted mb-2"><strong>Step 1 — Select Website</strong> से उस site को चुनें जिसका SEO update करना है। एक site का SEO दूसरे site पर apply नहीं होगा.</p>
                    <h6 class="fw-bold mt-3">3. Public Page चुनें</h6>
                    <p class="small text-muted mb-0"><strong>Step 2 — Select Public Page</strong> से Home, Results, Chart, Blog या उपलब्ध किसी public route को चुनें। SEO values उसी page के लिए save होंगी.</p>
                </div>
                <div class="col-lg-6">
                    <h6 class="fw-bold">4. Basic SEO / मुख्य SEO</h6>
                    <p class="small text-muted mb-2"><strong>Meta Title</strong> concise और page-specific रखें। <strong>Meta Description</strong> में page का वास्तविक summary दें। <strong>Focus Keyword</strong> मुख्य search phrase है; keyword stuffing न करें.</p>
                    <h6 class="fw-bold mt-3">5. Canonical + Robots</h6>
                    <p class="small text-muted mb-2"><strong>Canonical URL</strong> duplicate URLs में preferred URL बताता है। Normal indexable pages के लिए आमतौर पर <strong>index,follow</strong> रखें; जिस page को search results में नहीं चाहिए, उसके लिए ही noindex चुनें.</p>
                    <h6 class="fw-bold mt-3">6. Social + Schema</h6>
                    <p class="small text-muted mb-0"><strong>OG/Twitter</strong> fields social share preview के लिए हैं। <strong>Schema</strong> page/entity को structured information देता है; JSON-LD केवल valid और trusted data के साथ रखें.</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3">
                <div class="col-md-4"><div class="p-3 rounded bg-light h-100"><div class="fw-bold mb-1">Recommended routine</div><div class="small text-muted">हर important page के लिए title, description, canonical, robots और social preview check करें.</div></div></div>
                <div class="col-md-4"><div class="p-3 rounded bg-light h-100"><div class="fw-bold mb-1">Before Save</div><div class="small text-muted">URL path सही है, title/description page content से match करते हैं और accidental noindex नहीं लगा है—यह verify करें.</div></div></div>
                <div class="col-md-4"><div class="p-3 rounded bg-light h-100"><div class="fw-bold mb-1">After Save</div><div class="small text-muted">Success message देखकर अगले page पर जाएँ। Public site पर cache हो तो updated SEO दिखने में थोड़ा समय लग सकता है.</div></div></div>
            </div>
            <div class="alert alert-warning mt-4 mb-0 small"><strong>Important:</strong> SEO settings save करने से Google में ranking तुरंत change नहीं होती। यह module page metadata और related SEO information manage करता है; indexing/ranking Google के crawl और evaluation पर निर्भर करती है.</div>
        </div>
    </div>
</div>

<div class="collapse hidden mb-4" id="addWebsite">
    <div class="card">
        <div class="card-header p-4">
            <h5 class="mb-1">Add Website / नई वेबसाइट</h5>
            <div class="small text-muted">हर website का SEO अलग manage किया जा सकता है.</div>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.seo.manager.sites.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Website Name / वेबसाइट नाम</label><input class="form-control" name="name" placeholder="Lucky Satta" required></div>
                    <div class="col-md-6"><label class="form-label">Domain / डोमेन</label><input class="form-control" name="domain" placeholder="example.com" required></div>
                    <div class="col-md-3"><label class="form-label">Protocol / प्रोटोकॉल</label><select class="form-select" name="scheme"><option value="https">HTTPS</option><option value="http">HTTP</option></select></div>
                    <div class="col-md-9"><label class="form-label">Logo URL / लोगो URL</label><input class="form-control" type="url" name="logo_url" placeholder="https://example.com/logo.png"></div>
                    <div class="col-md-6"><label class="form-label">Organization Name / संस्था नाम</label><input class="form-control" name="organization_name" placeholder="Lucky Satta"></div>
                    <div class="col-md-6"><label class="form-label">Social Profiles / सोशल लिंक</label><textarea class="form-control" name="same_as" rows="3" placeholder="One URL per line / हर लाइन में एक URL"></textarea></div>
                </div>
                <button class="btn btn-success mt-3">Save Website / वेबसाइट सेव करें</button>
            </form>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body p-4">
        <div class="row g-3 align-items-end">
            <div class="col-lg-6">
                <label class="form-label">Step 1 — Select Website / वेबसाइट चुनें</label>
                <select class="form-select form-select-lg" id="seoSiteSelect">
                    @foreach($sites as $site)
                        <option value="{{ $site->id }}" @selected($site->id == $selectedSite->id)>{{ $site->name }} — {{ $site->domain }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6">
                <label class="form-label">Step 2 — Select Public Page / पब्लिक पेज चुनें</label>
                <select class="form-select form-select-lg" id="seoPageSelect">
                    @foreach($selectedSite->pages as $sitePage)
                        <option value="{{ $sitePage->id }}" @selected($page && $sitePage->id == $page->id)>{{ $sitePage->label }} — {{ $sitePage->path }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

@if($page)
<form method="POST" action="{{ route('admin.seo.manager.pages.save', $page) }}" id="seoForm">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header p-4"><h5 class="mb-1">Basic SEO / मुख्य SEO</h5><div class="small text-muted">Google search result में दिखने वाली मुख्य जानकारी.</div></div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Page Name / पेज नाम</label><input class="form-control" name="label" value="{{ old('label', $page->label) }}" required></div>
                        <div class="col-md-6"><label class="form-label">URL Path / पेज URL</label><input class="form-control" name="path" value="{{ old('path', $page->path) }}" required></div>
                        <div class="col-md-6"><label class="form-label">Robots / रोबोट</label><select class="form-select" name="robots"><option value="index,follow" @selected(old('robots',$page->robots)==='index,follow')>Index + Follow</option><option value="noindex,follow" @selected(old('robots',$page->robots)==='noindex,follow')>No Index + Follow</option><option value="index,nofollow" @selected(old('robots',$page->robots)==='index,nofollow')>Index + No Follow</option><option value="noindex,nofollow" @selected(old('robots',$page->robots)==='noindex,nofollow')>No Index + No Follow</option></select></div>
                        <div class="col-12"><label class="form-label">Meta Title / मेटा टाइटल <span class="text-muted fw-normal">(max 60–65 recommended)</span></label><input class="form-control" maxlength="255" name="meta_title" id="metaTitle" value="{{ old('meta_title',$page->meta_title) }}" placeholder="Lucky Satta Result Today | Official Results"><div class="form-text"><span id="metaTitleCount">0</span> characters</div></div>
                        <div class="col-12"><label class="form-label">Meta Description / मेटा डिस्क्रिप्शन <span class="text-muted fw-normal">(max 155–160 recommended)</span></label><textarea class="form-control" maxlength="1000" rows="4" name="meta_description" id="metaDescription">{{ old('meta_description',$page->meta_description) }}</textarea><div class="form-text"><span id="metaDescriptionCount">0</span> characters</div></div>
                        <div class="col-md-6"><label class="form-label">Focus Keyword / मुख्य कीवर्ड</label><input class="form-control" name="focus_keyword" value="{{ old('focus_keyword',$page->focus_keyword) }}" placeholder="lucky satta result"></div>
                        <div class="col-md-6"><label class="form-label">Secondary Keywords / अतिरिक्त कीवर्ड</label><input class="form-control" name="secondary_keywords" value="{{ old('secondary_keywords',$page->secondary_keywords) }}" placeholder="result, chart, today result"></div>
                        <div class="col-md-8"><label class="form-label">Canonical URL / मुख्य URL</label><input type="url" class="form-control" name="canonical_url" value="{{ old('canonical_url',$page->canonical_url) }}" placeholder="https://example.com/page"></div>
                        <div class="col-md-4"><label class="form-label">Author / लेखक</label><input class="form-control" name="author" value="{{ old('author',$page->author) }}"></div>
                        <div class="col-md-6"><label class="form-label">Publish Date & Time / तारीख व समय</label><input type="datetime-local" class="form-control" name="published_at" value="{{ old('published_at',$page->published_at?->format('Y-m-d\\TH:i')) }}"></div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header p-4"><h5 class="mb-1">Google & Social / सोशल शेयर</h5><div class="small text-muted">Facebook, WhatsApp और X/Twitter preview के लिए.</div></div>
                <div class="card-body p-4"><div class="row g-3">
                    <div class="col-md-6"><label class="form-label">OG Title / शेयर टाइटल</label><input class="form-control" name="og_title" value="{{ old('og_title',$page->og_title) }}"></div>
                    <div class="col-md-6"><label class="form-label">OG Image URL / शेयर इमेज</label><input type="url" class="form-control" name="og_image" value="{{ old('og_image',$page->og_image) }}"></div>
                    <div class="col-12"><label class="form-label">OG Description / शेयर विवरण</label><textarea class="form-control" rows="3" name="og_description">{{ old('og_description',$page->og_description) }}</textarea></div>
                    <div class="col-md-6"><label class="form-label">Twitter/X Title</label><input class="form-control" name="twitter_title" value="{{ old('twitter_title',$page->twitter_title) }}"></div>
                    <div class="col-md-6"><label class="form-label">Twitter/X Image URL</label><input type="url" class="form-control" name="twitter_image" value="{{ old('twitter_image',$page->twitter_image) }}"></div>
                    <div class="col-12"><label class="form-label">Twitter/X Description</label><textarea class="form-control" rows="3" name="twitter_description">{{ old('twitter_description',$page->twitter_description) }}</textarea></div>
                </div></div>
            </div>

            <div class="card mb-4">
                <div class="card-header p-4"><h5 class="mb-1">Structured Data / Schema</h5><div class="small text-muted">Google को page के प्रकार और organization की जानकारी.</div></div>
                <div class="card-body p-4"><div class="row g-3">
                    <div class="col-md-4"><label class="form-label">Schema Type / प्रकार</label><select class="form-select" name="schema_type"><option value="WebPage" @selected(old('schema_type',$page->schema_type)==='WebPage')>WebPage</option><option value="WebSite" @selected(old('schema_type',$page->schema_type)==='WebSite')>WebSite</option><option value="Article" @selected(old('schema_type',$page->schema_type)==='Article')>Article</option><option value="Organization" @selected(old('schema_type',$page->schema_type)==='Organization')>Organization</option></select></div>
                    <div class="col-md-8"><label class="form-label">Schema JSON-LD / Schema Code</label><textarea class="form-control font-monospace" rows="8" name="schema_json" placeholder='{"@context":"https://schema.org","@type":"WebPage"}'>{{ old('schema_json',$page->schema_json ? json_encode($page->schema_json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) : '') }}</textarea></div>
                    <div class="col-12"><label class="form-label">Extra Head Tags / अतिरिक्त Head Code</label><textarea class="form-control font-monospace" rows="6" name="extra_head" placeholder="Custom trusted meta/link/script tags">{{ old('extra_head',$page->extra_head) }}</textarea><div class="form-text">Only trusted admin HTML रखें.</div></div>
                </div></div>
            </div>

            <button class="btn btn-primary btn-lg px-4" id="seoSaveButton">Save SEO / SEO सेव करें</button>
        </div>

        <div class="col-xl-4">
            <div class="card position-sticky" style="top:1rem">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2"><strong>SEO Health / SEO स्थिति</strong><span class="badge text-bg-{{ $seoScore >= 80 ? 'success' : ($seoScore >= 50 ? 'warning' : 'danger') }}">{{ $seoScore }}%</span></div>
                    <div class="progress mb-3"><div class="progress-bar" style="width:{{ $seoScore }}%"></div></div>
                    <div class="small text-muted mb-3">जितने fields पूरे होंगे, score उतना बेहतर होगा.</div>
                    <div class="small">
                        <div class="mb-2">✓ Meta title / मेटा टाइटल</div>
                        <div class="mb-2">✓ Description / विवरण</div>
                        <div class="mb-2">✓ Focus keyword / मुख्य कीवर्ड</div>
                        <div class="mb-2">✓ Canonical / कैनोनिकल</div>
                        <div class="mb-2">✓ Social preview / सोशल</div>
                        <div>✓ Schema / स्ट्रक्चर्ड डेटा</div>
                    </div>
                    <hr>
                    <div class="small text-muted">Tip / सुझाव: Title और description में page का असली content साफ़ रखें; keyword भरने के लिए keyword stuffing न करें.</div>
                </div>
            </div>
        </div>
    </div>
</form>
@endif

<script>
(() => {
    const sites = @json($sites->mapWithKeys(fn ($s) => [$s->id => $s->pages->map(fn ($p) => ['id' => $p->id, 'label' => $p->label, 'path' => $p->path])]));
    const siteSelect = document.getElementById('seoSiteSelect');
    const pageSelect = document.getElementById('seoPageSelect');

    siteSelect?.addEventListener('change', () => {
        const pages = sites[siteSelect.value] || [];
        const url = new URL(window.location.href);
        url.searchParams.set('site', siteSelect.value);
        pages[0] ? url.searchParams.set('page', pages[0].id) : url.searchParams.delete('page');
        window.location.assign(url.toString());
    });

    pageSelect?.addEventListener('change', () => {
        const url = new URL(window.location.href);
        url.searchParams.set('site', siteSelect.value);
        url.searchParams.set('page', pageSelect.value);
        window.location.assign(url.toString());
    });

    const bindCounter = (inputId, countId) => {
        const input = document.getElementById(inputId);
        const count = document.getElementById(countId);
        if (!input || !count) return;
        const update = () => { count.textContent = input.value.length; };
        input.addEventListener('input', update);
        update();
    };
    bindCounter('metaTitle', 'metaTitleCount');
    bindCounter('metaDescription', 'metaDescriptionCount');
})();
</script>
@endsection
