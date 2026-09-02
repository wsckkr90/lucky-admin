<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Khaiwal;
use Illuminate\Http\Request;

class KhaiwalController extends Controller
{
    /**
     * Display all khaiwals.
     */
    public function index()
    {
        $khaiwals = Khaiwal::query()
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(20);

        return view(
            'admin.khaiwals.index',
            compact('khaiwals')
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view(
            'admin.khaiwals.create'
        );
    }

    /**
     * Store khaiwal.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'legacy_id' => [
                'nullable',
                'string',
                'max:100',
                'unique:khaiwals,legacy_id',
            ],

            'top_header' => [
                'nullable',
                'string',
            ],

            'cta_text' => [
                'nullable',
                'string',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:50',
            ],

            'telegram' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'schedule' => [
                'nullable',
                'array',
            ],

            'schedule.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        Khaiwal::create([
            'legacy_id' =>
                $validated['legacy_id']
                ?? null,

            'name' =>
                $validated['name'],

            'top_header' =>
                $validated['top_header']
                ?? null,

            'cta_text' =>
                $validated['cta_text']
                ?? null,

            'whatsapp' =>
                $validated['whatsapp']
                ?? null,

            'telegram' =>
                $validated['telegram']
                ?? null,

            'schedule' =>
                $validated['schedule']
                ?? [],

            'active' =>
                $request->boolean(
                    'active'
                ),

            'display_order' =>
                (int) (
                    $validated['display_order']
                    ?? 0
                ),
        ]);

        return redirect()
            ->route(
                'admin.khaiwals.index'
            )
            ->with(
                'success',
                'Khaiwal created successfully.'
            );
    }

    /**
     * Show edit form.
     */
    public function edit(
        Khaiwal $khaiwal
    ) {
        return view(
            'admin.khaiwals.edit',
            compact('khaiwal')
        );
    }

    /**
     * Update khaiwal.
     */
    public function update(
        Request $request,
        Khaiwal $khaiwal
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'legacy_id' => [
                'nullable',
                'string',
                'max:100',
                'unique:khaiwals,legacy_id,' .
                    $khaiwal->id,
            ],

            'top_header' => [
                'nullable',
                'string',
            ],

            'cta_text' => [
                'nullable',
                'string',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:50',
            ],

            'telegram' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'schedule' => [
                'nullable',
                'array',
            ],

            'schedule.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $khaiwal->update([
            'legacy_id' =>
                $validated['legacy_id']
                ?? null,

            'name' =>
                $validated['name'],

            'top_header' =>
                $validated['top_header']
                ?? null,

            'cta_text' =>
                $validated['cta_text']
                ?? null,

            'whatsapp' =>
                $validated['whatsapp']
                ?? null,

            'telegram' =>
                $validated['telegram']
                ?? null,

            'schedule' =>
                $validated['schedule']
                ?? [],

            'active' =>
                $request->boolean(
                    'active'
                ),

            'display_order' =>
                (int) (
                    $validated['display_order']
                    ?? 0
                ),
        ]);

        return redirect()
            ->route(
                'admin.khaiwals.index'
            )
            ->with(
                'success',
                'Khaiwal updated successfully.'
            );
    }

    /**
     * Delete khaiwal.
     */
    public function destroy(
        Khaiwal $khaiwal
    ) {
        $khaiwal->delete();

        return redirect()
            ->route(
                'admin.khaiwals.index'
            )
            ->with(
                'success',
                'Khaiwal deleted successfully.'
            );
    }

    /**
     * Toggle active status.
     */
    public function toggle(
        Khaiwal $khaiwal
    ) {
        $khaiwal->update([
            'active' =>
                !$khaiwal->active,
        ]);

        return back()->with(
            'success',
            $khaiwal->active
                ? 'Khaiwal activated.'
                : 'Khaiwal deactivated.'
        );
    }
}
