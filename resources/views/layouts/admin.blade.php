<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin Dashboard')
        - {{ config('app.name') }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        body {
            background: #f5f7fb;
        }

        .admin-wrapper {
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background: #111827;
            color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
        }

        .admin-topbar {
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .admin-content {
            padding: 25px;
        }

        .brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .sidebar-section {
            padding: 18px 15px 8px;
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 3px 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: #d1d5db;
            text-decoration: none;
            transition: .15s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: #1f2937;
            color: #fff;
        }

        .stat-card {
            border: 0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,.05);
        }

        @media (max-width: 991px) {
            .admin-sidebar {
                width: 220px;
            }

            .admin-main {
                margin-left: 220px;
            }
        }

        @media (max-width: 767px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    <aside
        class="admin-sidebar"
        id="adminSidebar"
    >

        <div class="brand">
            {{ config('app.name') }}
        </div>

        <div class="sidebar-section">
            Dashboard
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >
            <span>▣</span>
            Dashboard
        </a>

        <div class="sidebar-section">
    Results
</div>

@can('results.view')

<a
    href="{{ route('admin.results.today') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.results.today') ? 'active' : '' }}"
>
    <span>◆</span>
    Today's Results
</a>

@endcan

@can('results.view')

<a
    href="{{ route('admin.results.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.results.index') ? 'active' : '' }}"
>
    <span>◫</span>
    Result History
</a>

@endcan
@can('results.create')

<a
    href="{{ route('admin.results.create') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.results.create') ? 'active' : '' }}"
>
    <span>✎</span>
    Manual Result
</a>

@endcan
@can('charts.view')

<a
    href="{{ route('admin.charts.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.charts.*') ? 'active' : '' }}"
>
    <span>▤</span>
    Historical Charts
</a>

@endcan
<a
    href="#"
    class="sidebar-link"
>
    <span>◎</span>
    Lucky Numbers
</a>

@can('scraper.view')

<a
    href="{{ route('admin.scraper.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.scraper.*') ? 'active' : '' }}"
>
    <span>⟳</span>
    Scraper
</a>

@endcan

        <div class="sidebar-section">
            Games
        </div>

        @can('games.view')

<a
    href="{{ route('admin.games.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.games.*') ? 'active' : '' }}"
>
    <span>◆</span>
    Games
</a>

@endcan

        @can('cities.view')

<a
    href="{{ route('admin.cities.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}"
>
    <span>⌂</span>
    Cities
</a>

@endcan
        <div class="sidebar-section">
            Content
        </div>

        <a href="#" class="sidebar-link">
            <span>▤</span>
            Blogs
        </a>

        @can('faqs.view')

<a
    href="{{ route('admin.faqs.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"
>
    <span>?</span>
    FAQs
</a>

@endcan
        @can('seo.view')

<a
    href="{{ route('admin.seo.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}"
>
    <span>SEO</span>
    SEO Manager
</a>

@endcan

        @can('khaiwals.view')

<a
    href="{{ route('admin.khaiwals.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.khaiwals.*')
            ? 'active'
            : '' }}"
>
    <span>👤</span>
    Khaiwals
</a>

@endcan
        @can('social.view')

<a
    href="{{ route('admin.social.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.social.*') ? 'active' : '' }}"
>
    <span>●</span>
    Social Channels
</a>

@endcan

        <a href="#" class="sidebar-link">
            <span>☰</span>
            Forum
        </a>

        <div class="sidebar-section">
            Administration
        </div>

        @can('users.view')

<a
    href="{{ route('admin.users.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
>
    <span>♙</span>
    Staff Users
</a>

@endcan

       @can('roles.view')

<a href="{{ route('admin.roles.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
>
    <span>◆</span>
    Roles
</a>

@endcan

        @can('permissions.view')

<a
    href="{{ route('admin.permissions.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}"
>
    <span>✓</span>
    Permissions
</a>

@endcan

       @can('activity-logs.view')

<a
    href="{{ route('admin.activity-logs.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}"
>
    <span>◷</span>
    Activity Logs
</a>

@endcan

        <div class="sidebar-section">
            System
        </div>

       @can('settings.view')

<a
    href="{{ route('admin.settings.index') }}"
    class="sidebar-link
        {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
>
    <span>⚙</span>
    Settings
</a>

@endcan

        <a href="#" class="sidebar-link">
            <span>↻</span>
            Cache
        </a>

        <a href="#" class="sidebar-link">
            <span>⏱</span>
            Scheduler
        </a>

    </aside>

    <main class="admin-main">

        <header class="admin-topbar">

            <div>
                <button
                    type="button"
                    class="btn btn-outline-secondary d-md-none"
                    onclick="toggleSidebar()"
                >
                    ☰
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">

                @auth
                    <span>
                        {{ auth()->user()->name }}
                    </span>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-danger btn-sm"
                        >
                            Logout
                        </button>
                    </form>
                @endauth

            </div>

        </header>

        <div class="admin-content">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </div>

    </main>

</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('adminSidebar');

    sidebar.classList.toggle('show');
}
</script>

</body>
</html>
