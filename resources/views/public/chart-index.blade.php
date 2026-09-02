@extends('layouts.public')

@section('content')

<div class="container-fluid py-4">

    <div class="text-center mb-4">

        <h1>
            SATTA CHART
        </h1>

        <p class="text-muted">
            Satta King and Matka Historical Charts
        </p>

    </div>


    <div class="table-responsive">

        <table class="table table-striped table-bordered table-hover">

            <thead>

                <tr>

                    <th class="text-center">
                        Games
                    </th>

                    @foreach($availableYears as $year)

                        <th class="text-center">
                            {{ $year }} Charts
                        </th>

                    @endforeach

                </tr>

            </thead>


            <tbody>

            @forelse($games as $game)

                <tr>

                    <td class="text-center">

                        <strong>
                            {{ $game->name }}
                        </strong>

                        @if($game->open_time)

                            <br>

                            <small class="text-muted">
                                {{ $game->open_time }}
                            </small>

                        @endif

                    </td>


                    @foreach($availableYears as $year)

                        <td class="text-center">

                            <a
                                href="{{ route(
                                    'chart.game',
                                    [
                                        'game' =>
                                            $game->legacy_id
                                            ?: $game->slug,

                                        'year' =>
                                            $year,
                                    ]
                                ) }}"
                                class="text-decoration-none"
                            >
                                {{ $year }}
                            </a>

                        </td>

                    @endforeach

                </tr>

            @empty

                <tr>

                    <td
                        colspan="{{ count($availableYears) + 1 }}"
                        class="text-center py-5"
                    >
                        No active games found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection