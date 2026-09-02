@extends('layouts.admin')

@section('title', 'SEO Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            SEO Management
        </h2>

        <p class="text-muted mb-0">
            Manage technical SEO for games.
        </p>

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="card border-0 shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>
                    <th>#</th>
                    <th>Game</th>
                    <th>Meta Title</th>
                    <th>Focus Keyword</th>
                    <th>Canonical</th>
                    <th>SEO</th>
                    <th class="text-end">
                        Actions
                    </th>
                </tr>

            </thead>


            <tbody>

            @forelse($games as $game)

                @php
                    $seo = $game->seoMeta;
                @endphp

                <tr>

                    <td>
                        {{ $games->firstItem() + $loop->index }}
                    </td>


                    <td>

                        <strong>
                            {{ $game->name }}
                        </strong>

                        <div class="small text-muted">
                            {{ $game->slug }}
                        </div>

                    </td>


                    <td>

                        @if($seo?->meta_title)

                            <span>
                                {{ Str::limit(
                                    $seo->meta_title,
                                    60
                                ) }}
                            </span>

                        @else

                            <span class="text-muted">
                                Not configured
                            </span>

                        @endif

                    </td>


                    <td>
                        {{ $seo?->focus_keyword ?: '—' }}
                    </td>


                    <td>

                        @if($seo?->canonical_url)

                            <span
                                class="text-success"
                            >
                                Configured
                            </span>

                        @else

                            <span class="text-warning">
                                Default
                            </span>

                        @endif

                    </td>


                    <td>

                        @if($seo)

                            <span class="badge bg-success">
                                Configured
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Missing
                            </span>

                        @endif

                    </td>


                    <td class="text-end">

                        <a
    href="{{ route(
        'admin.seo.edit',
        [
            'type' => 'game',
            'id' => $game->id,
        ]
    ) }}"
>
    Edit SEO
</a>

                        <a
                            href="{{ route(
                                'admin.seo.content.index',
                                $game
                            ) }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Content

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        class="text-center py-5 text-muted"
                    >
                        No active games found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">

    {{ $games->links() }}

</div>

@endsection
