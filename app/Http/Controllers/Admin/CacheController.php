<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function index()
    {
        return view('admin.cache.index', [
            'driver' => config('cache.default'),
        ]);
    }

    public function clear()
    {
        Cache::flush();

        return redirect()
            ->route('admin.cache.index')
            ->with('success', 'Application cache cleared successfully.');
    }
}
