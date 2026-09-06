@extends('layouts.admin')

@section('title', 'Dashboard / डैशबोर्ड')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <div class="text-uppercase small text-muted fw-bold">Control Center / कंट्रोल सेंटर</div>
        <h2 class="mb-1">Dashboard / डैशबोर्ड</h2>
        <p class="text-muted mb-0">Website की मुख्य जानकारी एक जगह देखें और काम जल्दी शुरू करें.</p>
    </div>
    <div class="page-actions">
        @can('results.create')<a href="{{ route('admin.results.create') }}" class="btn btn-primary">＋ Manual Result / रिज़ल्ट डालें</a>@endcan
        @can('games.view')<a href="{{ route('admin.games.index') }}" class="btn btn-outline-primary">Games / गेम्स</a>@endcan
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="card stat-card h-100"><div class="card-body p-4"><div class="small text-muted mb-2">Staff Users / यूज़र</div><div class="fs-2 fw-bold">{{ $stats['users'] }}</div><div class="small text-muted mt-2">Admin panel accounts</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="card stat-card h-100"><div class="card-body p-4"><div class="small text-muted mb-2">Active Cities / शहर</div><div class="fs-2 fw-bold">{{ $stats['cities'] }}</div><div class="small text-muted mt-2">Available locations</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="card stat-card h-100"><div class="card-body p-4"><div class="small text-muted mb-2">Active Games / गेम्स</div><div class="fs-2 fw-bold">{{ $stats['games'] }}</div><div class="small text-muted mt-2">Live game setup</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="card stat-card h-100"><div class="card-body p-4"><div class="small text-muted mb-2">Today's Results / आज के रिज़ल्ट</div><div class="fs-2 fw-bold">{{ $stats['today_results'] }}</div><div class="small text-muted mt-2">Results published today</div></div></div></div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="card h-100">
            <div class="card-header p-4"><h5 class="mb-1">Quick Actions / जल्दी काम</h5><div class="small text-muted">बार-बार होने वाले काम यहाँ से करें.</div></div>
            <div class="card-body p-4"><div class="row g-3">
                @can('results.view')<div class="col-md-6"><a class="btn btn-outline-primary w-100 text-start py-3" href="{{ route('admin.results.today') }}">Today's Result / आज का रिज़ल्ट<br><small class="text-muted">आज के सभी game results देखें</small></a></div>@endcan
                @can('results.view')<div class="col-md-6"><a class="btn btn-outline-primary w-100 text-start py-3" href="{{ route('admin.results.index') }}">Result History / पुराना रिज़ल्ट<br><small class="text-muted">Date के हिसाब से history देखें</small></a></div>@endcan
                @can('charts.view')<div class="col-md-6"><a class="btn btn-outline-primary w-100 text-start py-3" href="{{ route('admin.charts.index') }}">Charts / चार्ट<br><small class="text-muted">Historical chart data देखें</small></a></div>@endcan
                @can('seo.view')<div class="col-md-6"><a class="btn btn-outline-primary w-100 text-start py-3" href="{{ route('admin.seo.manager.index') }}">SEO Manager / SEO<br><small class="text-muted">Website और public pages का SEO manage करें</small></a></div>@endcan
            </div></div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-header p-4"><h5 class="mb-1">Admin Tips / आसान सुझाव</h5><div class="small text-muted">Panel इस्तेमाल करने का आसान तरीका.</div></div>
            <div class="card-body p-4">
                <div class="small mb-3"><strong>1.</strong> पहले <b>Games / गेम्स</b> में game और city setup करें.</div>
                <div class="small mb-3"><strong>2.</strong> फिर <b>Results / रिज़ल्ट</b> में आज का result update करें.</div>
                <div class="small mb-3"><strong>3.</strong> SEO के लिए <b>SEO Manager</b> में website और page चुनें.</div>
                <div class="small"><strong>4.</strong> कोई भी form save करते समय required fields खाली न छोड़ें.</div>
            </div>
        </div>
    </div>
</div>
@endsection
