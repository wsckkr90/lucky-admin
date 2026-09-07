<!DOCTYPE html>
<html lang="{{ session('admin_locale', 'en') === 'hi' ? 'hi' : 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#172554">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="admin-body">
<div class="admin-shell" id="adminShell">
    <div class="admin-overlay" id="adminOverlay" onclick="closeSidebar()"></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Admin navigation">
        <div class="admin-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-mark" aria-label="{{ config('app.name') }} admin home">
                <span class="brand-mark-dot"></span>
                <span><strong>{{ config('app.name') }}</strong><small>Admin Panel / एडमिन पैनल</small></span>
            </a>
            <button type="button" class="sidebar-close" aria-label="Close navigation" onclick="closeSidebar()">×</button>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="sidebar-icon">⌂</span><span>Dashboard / डैशबोर्ड</span></a>

            <div class="sidebar-group {{ request()->routeIs('admin.results.*','admin.charts.*','admin.lucky-numbers.*','admin.scraper.*') ? 'open' : '' }}" data-sidebar-group="results">
                <button type="button" class="sidebar-group-toggle" aria-expanded="{{ request()->routeIs('admin.results.*','admin.charts.*','admin.lucky-numbers.*','admin.scraper.*') ? 'true' : 'false' }}"><span><span class="sidebar-icon">◆</span> Results / रिज़ल्ट</span><span class="sidebar-chevron">⌄</span></button>
                <div class="sidebar-submenu">
                    @can('results.view')<a href="{{ route('admin.results.today') }}" class="sidebar-link {{ request()->routeIs('admin.results.today') ? 'active' : '' }}"><span class="sidebar-icon">●</span><span>Today / आज का रिज़ल्ट</span></a>@endcan
                    @can('results.view')<a href="{{ route('admin.results.index') }}" class="sidebar-link {{ request()->routeIs('admin.results.index') ? 'active' : '' }}"><span class="sidebar-icon">▤</span><span>History / इतिहास</span></a>@endcan
                    @can('results.create')<a href="{{ route('admin.results.create') }}" class="sidebar-link {{ request()->routeIs('admin.results.create') ? 'active' : '' }}"><span class="sidebar-icon">＋</span><span>Manual Result / मैनुअल रिज़ल्ट</span></a>@endcan
                    @can('charts.view')<a href="{{ route('admin.charts.index') }}" class="sidebar-link {{ request()->routeIs('admin.charts.*') ? 'active' : '' }}"><span class="sidebar-icon">▥</span><span>Charts / चार्ट</span></a>@endcan
                    @can('lucky-numbers.view')<a href="{{ route('admin.lucky-numbers.index') }}" class="sidebar-link {{ request()->routeIs('admin.lucky-numbers.*') ? 'active' : '' }}"><span class="sidebar-icon">★</span><span>Lucky Numbers / लकी नंबर</span></a>@endcan
                    @can('scraper.view')<a href="{{ route('admin.scraper.index') }}" class="sidebar-link {{ request()->routeIs('admin.scraper.*') ? 'active' : '' }}"><span class="sidebar-icon">↻</span><span>Scraper / डेटा स्क्रैपर</span></a>@endcan
                </div>
            </div>

            <div class="sidebar-group {{ request()->routeIs('admin.games.*','admin.cities.*') ? 'open' : '' }}" data-sidebar-group="games">
                <button type="button" class="sidebar-group-toggle" aria-expanded="{{ request()->routeIs('admin.games.*','admin.cities.*') ? 'true' : 'false' }}"><span><span class="sidebar-icon">▦</span> Games / गेम्स</span><span class="sidebar-chevron">⌄</span></button>
                <div class="sidebar-submenu">
                    @can('games.view')<a href="{{ route('admin.games.index') }}" class="sidebar-link {{ request()->routeIs('admin.games.*') ? 'active' : '' }}"><span class="sidebar-icon">◆</span><span>Games / गेम्स</span></a>@endcan
                    @can('cities.view')<a href="{{ route('admin.cities.index') }}" class="sidebar-link {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}"><span class="sidebar-icon">⌖</span><span>Cities / शहर</span></a>@endcan
                </div>
            </div>

            <div class="sidebar-group {{ request()->routeIs('admin.blogs.*','admin.faqs.*','admin.seo.*','admin.social.*','admin.forum.*','admin.khaiwals.*') ? 'open' : '' }}" data-sidebar-group="content">
                <button type="button" class="sidebar-group-toggle" aria-expanded="{{ request()->routeIs('admin.blogs.*','admin.faqs.*','admin.seo.*','admin.social.*','admin.forum.*','admin.khaiwals.*') ? 'true' : 'false' }}"><span><span class="sidebar-icon">▤</span> Content / कंटेंट</span><span class="sidebar-chevron">⌄</span></button>
                <div class="sidebar-submenu">
                    @can('blogs.view')<a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"><span class="sidebar-icon">✎</span><span>Blogs / ब्लॉग</span></a>@endcan
                    @can('faqs.view')<a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"><span class="sidebar-icon">?</span><span>FAQs / सवाल-जवाब</span></a>@endcan
                    @can('seo.view')<a href="{{ route('admin.seo.manager.index') }}" class="sidebar-link {{ request()->routeIs('admin.seo.manager.*') ? 'active' : '' }}"><span class="sidebar-icon">SEO</span><span>SEO Manager / SEO</span></a>@endcan
                    @can('seo.view')<a href="{{ route('admin.seo.index') }}" class="sidebar-link {{ request()->routeIs('admin.seo.index','admin.seo.edit','admin.seo.content.*','admin.seo.faq.*') ? 'active' : '' }}"><span class="sidebar-icon">⌁</span><span>Game SEO / गेम SEO</span></a>@endcan
                    @can('social.view')<a href="{{ route('admin.social.index') }}" class="sidebar-link {{ request()->routeIs('admin.social.*') ? 'active' : '' }}"><span class="sidebar-icon">●</span><span>Social / सोशल लिंक</span></a>@endcan
                    @can('forum.view')<a href="{{ route('admin.forum.index') }}" class="sidebar-link {{ request()->routeIs('admin.forum.*') ? 'active' : '' }}"><span class="sidebar-icon">☰</span><span>Forum / फोरम</span></a>@endcan
                    @can('khaiwals.view')<a href="{{ route('admin.khaiwals.index') }}" class="sidebar-link {{ request()->routeIs('admin.khaiwals.*') ? 'active' : '' }}"><span class="sidebar-icon">♙</span><span>Khaiwals / संचालक</span></a>@endcan
                </div>
            </div>

            <div class="sidebar-group {{ request()->routeIs('admin.users.*','admin.roles.*','admin.permissions.*','admin.activity-logs.*') ? 'open' : '' }}" data-sidebar-group="admin">
                <button type="button" class="sidebar-group-toggle" aria-expanded="{{ request()->routeIs('admin.users.*','admin.roles.*','admin.permissions.*','admin.activity-logs.*') ? 'true' : 'false' }}"><span><span class="sidebar-icon">♙</span> Administration / प्रशासन</span><span class="sidebar-chevron">⌄</span></button>
                <div class="sidebar-submenu">
                    @can('users.view')<a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><span class="sidebar-icon">♙</span><span>Staff Users / यूज़र</span></a>@endcan
                    @can('roles.view')<a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"><span class="sidebar-icon">◆</span><span>Roles / भूमिका</span></a>@endcan
                    @can('permissions.view')<a href="{{ route('admin.permissions.index') }}" class="sidebar-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}"><span class="sidebar-icon">✓</span><span>Permissions / अनुमति</span></a>@endcan
                    @can('activity-logs.view')<a href="{{ route('admin.activity-logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}"><span class="sidebar-icon">◷</span><span>Activity Logs / हिस्ट्री</span></a>@endcan
                </div>
            </div>

            <div class="sidebar-group {{ request()->routeIs('admin.settings.*','admin.cache.*','admin.scheduler.*') ? 'open' : '' }}" data-sidebar-group="system">
                <button type="button" class="sidebar-group-toggle" aria-expanded="{{ request()->routeIs('admin.settings.*','admin.cache.*','admin.scheduler.*') ? 'true' : 'false' }}"><span><span class="sidebar-icon">⚙</span> System / सिस्टम</span><span class="sidebar-chevron">⌄</span></button>
                <div class="sidebar-submenu">
                    @can('settings.view')<a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><span class="sidebar-icon">⚙</span><span>Settings / सेटिंग्स</span></a>@endcan
                    @can('cache.view')<a href="{{ route('admin.cache.index') }}" class="sidebar-link {{ request()->routeIs('admin.cache.*') ? 'active' : '' }}"><span class="sidebar-icon">↻</span><span>Cache / कैश</span></a>@endcan
                    @can('scheduler.view')<a href="{{ route('admin.scheduler.index') }}" class="sidebar-link {{ request()->routeIs('admin.scheduler.*') ? 'active' : '' }}"><span class="sidebar-icon">⏱</span><span>Scheduler / शेड्यूलर</span></a>@endcan
                </div>
            </div>
        </nav>

        <div class="sidebar-footer"><div class="sidebar-footer-status"><span class="status-dot"></span><span>System Online / सिस्टम चालू</span></div><small>v{{ app()->version() }}</small></div>
    </aside>

    <main class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left"><button type="button" class="mobile-menu-btn" aria-label="Open navigation" onclick="openSidebar()">☰</button><div class="topbar-title"><span class="eyebrow">ADMIN PANEL / एडमिन पैनल</span><strong>@yield('title', 'Dashboard')</strong></div></div>
            <div class="topbar-right">
                <form method="POST" action="{{ route('admin.locale.update') }}" class="language-form" title="Language / भाषा">@csrf <span class="language-icon">文</span><select name="locale" onchange="this.form.submit()" aria-label="Language"><option value="en" @selected(session('admin_locale','en') === 'en')>English</option><option value="hi" @selected(session('admin_locale','en') === 'hi')>हिन्दी</option></select></form>
                @auth
                    <div class="user-chip"><span class="user-avatar">{{ mb_strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}</span><span class="user-details"><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></span></div>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">@csrf<button type="submit" class="logout-btn">Logout / बाहर</button></form>
                @endauth
            </div>
        </header>

        <div class="admin-content">
            @if(session('success'))
                <div id="admin-success-alert" class="admin-alert admin-alert-success flex items-start justify-between gap-4" role="alert">
                    <div><strong>Success / सफल:</strong> {{ session('success') }}</div>
                    <button type="button" data-dismiss-target="#admin-success-alert" aria-label="Dismiss">×</button>
                </div>
            @endif
            @if(session('error'))
                <div id="admin-error-alert" class="admin-alert admin-alert-danger flex items-start justify-between gap-4" role="alert">
                    <div><strong>Error / त्रुटि:</strong> {{ session('error') }}</div>
                    <button type="button" data-dismiss-target="#admin-error-alert" aria-label="Dismiss">×</button>
                </div>
            @endif
            @if($errors->any())
                <div id="admin-validation-alert" class="admin-alert admin-alert-danger flex items-start justify-between gap-4" role="alert">
                    <div><strong>Please check / कृपया जांचें:</strong> {{ $errors->first() }}</div>
                    <button type="button" data-dismiss-target="#admin-validation-alert" aria-label="Dismiss">×</button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js" defer></script>
<script>
function openSidebar(){document.getElementById('adminSidebar')?.classList.add('show');document.getElementById('adminOverlay')?.classList.add('show');document.body.classList.add('sidebar-open');}
function closeSidebar(){document.getElementById('adminSidebar')?.classList.remove('show');document.getElementById('adminOverlay')?.classList.remove('show');document.body.classList.remove('sidebar-open');}
</script>
</body>
</html>
