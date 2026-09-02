@extends('layouts.admin')

@section('title', 'Settings')

@section('content')

<div class="mb-4">

    <h2 class="mb-1">
        Settings
    </h2>

    <p class="text-muted mb-0">
        Manage global application configuration.
    </p>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<form
    method="POST"
    action="{{ route('admin.settings.update') }}"
>
    @csrf
    @method('PUT')


    @foreach($settings as $group => $groupSettings)

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0 text-capitalize">
                    {{ $group }}
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-3">

                    @foreach($groupSettings as $setting)

                        @php
                            $inputName = str_replace(
                                '.',
                                '__',
                                $setting->key
                            );
                        @endphp

                        <div class="col-md-6">

                            <label class="form-label">
                                {{ ucwords(
                                    str_replace(
                                        ['.', '_'],
                                        ' ',
                                        $setting->key
                                    )
                                ) }}
                            </label>

                            @if($setting->type === 'boolean')

                                <div class="form-check">

                                    <input
    type="hidden"
    name="{{ $group }}[{{ $inputName }}]"
    value="0"
>

<input
    type="checkbox"
    class="form-check-input"
    name="{{ $group }}[{{ $inputName }}]"
    value="1"
    @checked($setting->typed_value)
>
                                    <label class="form-check-label">
                                        Enabled
                                    </label>

                                </div>

                            @elseif(
                                str_contains(
                                    $setting->key,
                                    'note'
                                ) ||
                                str_contains(
                                    $setting->key,
                                    'text'
                                ) ||
                                str_contains(
                                    $setting->key,
                                    'header'
                                )
                            )

                                <textarea
                                    name="{{ $group }}[{{ $inputName }}]"
                                    class="form-control"
                                    rows="4"
                                >{{ $setting->value }}</textarea>

                            @else

                                <input
                                    type="text"
                                    name="{{ $group }}[{{ $inputName }}]"
                                    value="{{ $setting->value }}"
                                    class="form-control"
                                >

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endforeach


    <button
        type="submit"
        class="btn btn-primary"
    >
        Save Settings
    </button>

</form>

@endsection
