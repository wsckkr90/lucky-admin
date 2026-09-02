<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::query()
            ->withCount('games')
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(20);

        return view(
            'admin.cities.index',
            compact('cities')
        );
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:cities,slug',
            ],
            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['slug'] =
            $validated['slug']
            ?? Str::slug($validated['name']);

        $validated['active'] =
            $request->boolean('active');

        City::create($validated);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City created successfully.');
    }

    public function edit(City $city)
    {
        return view(
            'admin.cities.edit',
            compact('city')
        );
    }

    public function update(
        Request $request,
        City $city
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:cities,slug,' . $city->id,
            ],
            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['active'] =
            $request->boolean('active');

        $city->update($validated);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        if ($city->games()->exists()) {
            return redirect()
                ->route('admin.cities.index')
                ->with(
                    'error',
                    'Cannot delete a city containing games.'
                );
        }

        $city->delete();

        return redirect()
            ->route('admin.cities.index')
            ->with(
                'success',
                'City deleted successfully.'
            );
    }
}
