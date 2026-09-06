<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoPage;
use App\Models\SeoSite;
use Illuminate\Http\Request;

class SeoManagerController extends Controller
{
    private const DEFAULT_PAGES = [
        ['home', 'Home / होम', '/'],
        ['chart', 'Charts / चार्ट', '/chart'],
        ['blog-list', 'Blog List / ब्लॉग सूची', '/blog-list.php'],
        ['blog-detail', 'Blog Detail / ब्लॉग विवरण', '/blog-detail.php'],
        ['privacy-policy', 'Privacy Policy / गोपनीयता नीति', '/privacy-policy.php'],
        ['terms', 'Terms & Conditions / नियम व शर्तें', '/terms-and-conditions.php'],
        ['disclaimer', 'Disclaimer / अस्वीकरण', '/disclaimer.php'],
        ['contact', 'Contact / संपर्क', '/contact.php'],
    ];

    public function index(Request $request)
    {
        $sites = SeoSite::query()->with(['pages' => fn ($q) => $q->orderBy('id')])->orderBy('name')->get();
        if ($sites->isEmpty()) $sites = collect([$this->createDefaultSite()]);

        foreach ($sites as $site) {
            $this->ensureDefaultPages($site);
            $site->load(['pages' => fn ($q) => $q->orderBy('id')]);
        }

        $selectedSiteId = (int) ($request->integer('site') ?: $sites->first()->id);
        $selectedSite = $sites->firstWhere('id', $selectedSiteId) ?: $sites->first();
        $selectedPageId = (int) ($request->integer('page') ?: optional($selectedSite->pages->first())->id);
        $selectedPage = $selectedSite->pages->firstWhere('id', $selectedPageId) ?: $selectedSite->pages->first();

        return view('admin.seo.manager', compact('sites', 'selectedSite', 'selectedPage'));
    }

    public function storeSite(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'domain' => ['required', 'string', 'max:255'],
            'scheme' => ['required', 'in:http,https'],
            'logo_url' => ['nullable', 'url', 'max:2048'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'same_as' => ['nullable', 'string', 'max:4000'],
        ]);
        $data['domain'] = rtrim(preg_replace('#^https?://#i', '', trim($data['domain'])), '/');
        $data['same_as'] = $this->linesToArray($data['same_as'] ?? '');
        $data['active'] = true;
        $site = SeoSite::create($data);
        $this->ensureDefaultPages($site);
        return redirect()->route('admin.seo.index', ['site' => $site->id])->with('success', 'Website added / वेबसाइट जोड़ी गई।');
    }

    public function savePage(Request $request, SeoPage $seoPage)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:255'], 'path' => ['required', 'string', 'max:500'],
            'meta_title' => ['nullable', 'string', 'max:255'], 'meta_description' => ['nullable', 'string', 'max:1000'],
            'focus_keyword' => ['nullable', 'string', 'max:255'], 'secondary_keywords' => ['nullable', 'string', 'max:2000'],
            'canonical_url' => ['nullable', 'url', 'max:2048'], 'robots' => ['required', 'string', 'max:100'],
            'author' => ['nullable', 'string', 'max:255'], 'published_at' => ['nullable', 'date'],
            'og_title' => ['nullable', 'string', 'max:255'], 'og_description' => ['nullable', 'string', 'max:1000'], 'og_image' => ['nullable', 'url', 'max:2048'],
            'twitter_title' => ['nullable', 'string', 'max:255'], 'twitter_description' => ['nullable', 'string', 'max:1000'], 'twitter_image' => ['nullable', 'url', 'max:2048'],
            'schema_type' => ['nullable', 'string', 'max:100'], 'schema_json' => ['nullable', 'string', 'max:20000'], 'extra_head' => ['nullable', 'string', 'max:40000'],
        ]);

        if (!empty($data['schema_json'])) {
            $decoded = json_decode($data['schema_json'], true);
            if (json_last_error() !== JSON_ERROR_NONE) return back()->withInput()->withErrors(['schema_json' => 'Schema JSON is invalid / Schema JSON गलत है।']);
            $data['schema_json'] = $decoded;
        } else {
            $data['schema_json'] = null;
        }

        $seoPage->update($data);
        return redirect()->route('admin.seo.index', ['site' => $seoPage->seo_site_id, 'page' => $seoPage->id])->with('success', 'SEO saved / SEO सेव हो गया।');
    }

    private function createDefaultSite(): SeoSite
    {
        $url = config('app.url', 'https://lucky-sattaa.com');
        $parts = parse_url($url);
        return SeoSite::create([
            'name' => config('app.name', 'Lucky Satta'),
            'domain' => $parts['host'] ?? 'lucky-sattaa.com',
            'scheme' => $parts['scheme'] ?? 'https',
            'logo_url' => rtrim($url, '/') . '/logo.png',
            'organization_name' => config('app.name', 'Lucky Satta'),
            'same_as' => [],
            'active' => true,
        ]);
    }

    private function ensureDefaultPages(SeoSite $site): void
    {
        foreach (self::DEFAULT_PAGES as [$key, $label, $path]) {
            SeoPage::firstOrCreate(['seo_site_id' => $site->id, 'page_key' => $key], [
                'label' => $label, 'path' => $path, 'robots' => 'index,follow', 'schema_type' => $key === 'home' ? 'WebSite' : 'WebPage',
            ]);
        }
    }

    private function linesToArray(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value))->map(fn ($line) => trim($line))->filter()->values()->all();
    }
}
