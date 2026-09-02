@extends('layouts.public')

@section('content')

@php
    $gameKey = $game->legacy_id ?: $game->slug;
@endphp

<div class="container-fluid py-4">

    <div class="text-center mb-4">

        <h1>
            {{ $game->name }}
            Satta Result &amp; Chart
            {{ $selectedYear }}
        </h1>

        @if($game->city)

            <p class="text-muted mb-1">
                {{ $game->city->name }}
            </p>

        @endif

        <p class="text-muted mb-0">
            Historical Result Chart
        </p>

    </div>


    {{-- Year navigation --}}
    <div class="text-center mb-4">

        <div class="d-flex flex-wrap justify-content-center gap-2">

            @foreach($availableYears as $year)

                <a
                    href="{{ route(
                        'chart.game',
                        [
                            'game' =>
                                $gameKey,

                            'year' =>
                                $year,
                        ]
                    ) }}"
                    class="btn btn-sm
                        {{ $year === $selectedYear
                            ? 'btn-primary'
                            : 'btn-outline-primary' }}"
                >
                    {{ $year }}
                </a>

            @endforeach

        </div>

    </div>
<div class="d-flex flex-wrap justify-content-center gap-2 mb-4">

    @foreach($months as $monthIndex => $monthName)

        @php
            $monthNumber = $monthIndex + 1;
        @endphp

        <a
            href="{{ route(
                'chart.month',
                [
                    'game' =>
                        $game->legacy_id
                        ?: $game->slug,

                    'year' =>
                        $selectedYear,

                    'month' =>
                        $monthNumber,
                ]
            ) }}"
            class="btn btn-sm
                {{ $selectedMonth === $monthNumber
                    ? 'btn-primary'
                    : 'btn-outline-secondary' }}"
        >
            {{ $monthName }}
        </a>

    @endforeach

</div>

    {{-- Back --}}
    <div class="mb-3">

        <a
            href="{{ route('chart') }}"
            class="btn btn-sm btn-outline-secondary"
        >
            ← All Games
        </a>

    </div>


    {{-- Chart --}}
    <div class="table-responsive">

        <table
            class="table table-bordered table-striped table-hover text-center align-middle"
        >

            <thead class="table-light">

                <tr>

                    <th>
                        Date
                    </th>

                    @foreach($months as $month)

                        <th>
                            {{ $month }}
                        </th>

                    @endforeach

                </tr>

            </thead>

            <tbody>

            @for($day = 1; $day <= 31; $day++)

                <tr>

                    <td>
                        <strong>
                            {{ sprintf('%02d', $day) }}
                        </strong>
                    </td>


                    @for($month = 1; $month <= 12; $month++)

                        @php

                            $daysInMonth =
                                \Carbon\Carbon::create(
                                    $selectedYear,
                                    $month,
                                    1
                                )->daysInMonth;

                            if ($day > $daysInMonth) {

                                $displayValue = '--';

                            } else {

                                $dateKey = sprintf(
                                    '%04d-%02d-%02d',
                                    $selectedYear,
                                    $month,
                                    $day
                                );

                                $record =
                                    $results->get(
                                        $dateKey
                                    );

                                $isFuture =
                                    $selectedYear >
                                        $currentYear
                                    ||
                                    (
                                        $selectedYear ===
                                            $currentYear
                                        &&
                                        (
                                            $month >
                                                $currentMonth
                                            ||
                                            (
                                                $month ===
                                                    $currentMonth
                                                &&
                                                $day >
                                                    $currentDay
                                            )
                                        )
                                    );

                                if (
                                    $isFuture ||
                                    !$record ||
                                    trim(
                                        (string)
                                        $record->result
                                    ) === ''
                                ) {
                                    $displayValue = '--';
                                } else {
                                    $displayValue =
                                        $record->result;
                                }
                            }

                        @endphp


                        <td>
                            {{ $displayValue }}
                        </td>

                    @endfor

                </tr>

            @endfor

            </tbody>

        </table>

    </div>


    {{-- SEO Content --}}
    @if(
        $game->seoContents &&
        $game->seoContents->isNotEmpty()
    )

        <section class="mt-5">

            @foreach(
                $game->seoContents
                as $content
            )

                @if($content->active)

                    @if($content->title)

                        <h2 class="mb-3">
                            {{ $content->title }}
                        </h2>

                    @endif

                    <div class="mb-4">
                        {!! $content->content !!}
                    </div>

                @endif

            @endforeach

        </section>

    @endif


    {{-- FAQs --}}
    @if(
        $game->faqs &&
        $game->faqs->isNotEmpty()
    )

        <section class="mt-5">

            <h2 class="mb-4">
                Frequently Asked Questions
            </h2>

            @foreach(
                $game->faqs
                as $faq
            )

                @if($faq->active)

                    <div class="mb-4">

                        <h3 class="h5">
                            {{ $faq->question }}
                        </h3>

                        <div>
                            {!! $faq->answer !!}
                        </div>

                    </div>

                @endif

            @endforeach

        </section>

    @endif

</div>

@endsection
