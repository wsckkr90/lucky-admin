@extends('layouts.admin')

@section('title', 'Khaiwals')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Khaiwals
        </h2>

        <p class="text-muted mb-0">
            Manage khaiwal information and schedules.
        </p>
    </div>

    <a
        href="{{ route('admin.khaiwals.create') }}"
        class="btn btn-primary"
    >
        + Add Khaiwal
    </a>

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
                    <th>Name</th>
                    <th>WhatsApp</th>
                    <th>Telegram</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th class="text-end">Actions</th>
                </tr>

            </thead>

            <tbody>

            @forelse($khaiwals as $khaiwal)

                <tr>

                    <td>
                        {{ $khaiwals->firstItem() + $loop->index }}
                    </td>

                    <td>

                        <strong>
                            {{ $khaiwal->name }}
                        </strong>

                        @if($khaiwal->legacy_id)

                            <div class="small text-muted">
                                {{ $khaiwal->legacy_id }}
                            </div>

                        @endif

                    </td>

                    <td>
                        {{ $khaiwal->whatsapp ?? '—' }}
                    </td>

                    <td>

                        @if($khaiwal->telegram)

                            <a
                                href="{{ $khaiwal->telegram }}"
                                target="_blank"
                                rel="noopener"
                            >
                                Open
                            </a>

                        @else

                            —

                        @endif

                    </td>

                    <td>

                        @if(
                            is_array($khaiwal->schedule) &&
                            count($khaiwal->schedule)
                        )

                            {{ count($khaiwal->schedule) }}
                            items

                        @else

                            —

                        @endif

                    </td>

                    <td>

                        @if($khaiwal->active)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $khaiwal->display_order }}
                    </td>

                    <td class="text-end">

                        <a
                            href="{{ route(
                                'admin.khaiwals.edit',
                                $khaiwal
                            ) }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Edit
                        </a>


                        <form
                            method="POST"
                            action="{{ route(
                                'admin.khaiwals.toggle',
                                $khaiwal
                            ) }}"
                            class="d-inline"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                Toggle
                            </button>

                        </form>


                        <form
                            method="POST"
                            action="{{ route(
                                'admin.khaiwals.destroy',
                                $khaiwal
                            ) }}"
                            class="d-inline"
                            onsubmit="return confirm(
                                'Delete this khaiwal?'
                            );"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-danger"
                            >
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="8"
                        class="text-center py-5 text-muted"
                    >
                        No khaiwals found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">

    {{ $khaiwals->links() }}

</div>

@endsection
