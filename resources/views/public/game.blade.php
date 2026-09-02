@extends('layouts.public')

@section('content')

<div class="container py-5">

    <div class="mb-5">

        <h1>
            {{ $game->name }}
        </h1>

        @if($game->city)

            <p class="text-muted">
                {{ $game->city->name }}
            </p>

        @endif

    </div>


    {{-- Quick Chart Links --}}
    <div class="mb-5">

        <a
            href="{{ route(
                'chart.game',
                [
                    'game' =>
                        $game->legacy_id
                        ?: $game->slug,

                    'year' =>
                        now()->year,
                ]
            ) }}"
            class="btn btn-primary"
        >
            {{ now()->year }} Chart
        </a>

    </div>


    {{-- SEO Content --}}
    @foreach($game->seoContents as $content)

        @if($content->title)

            <h2 class="mb-3">
                {{ $content->title }}
            </h2>

        @endif

        <div class="mb-4">
            {!! $content->content !!}
        </div>

    @endforeach


    {{-- FAQs --}}
    @if($game->faqs->isNotEmpty())

        <section class="mt-5">

            <h2 class="mb-4">
                Frequently Asked Questions
            </h2>

            @foreach($game->faqs as $faq)

                <div class="mb-4">

                    <h3 class="h5">
                        {{ $faq->question }}
                    </h3>

                    <div>
                        {!! $faq->answer !!}
                    </div>

                </div>

            @endforeach

        </section>

    @endif

</div>

@endsection
