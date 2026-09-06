<?php

use App\Http\Controllers\Admin\SeoManagerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.seo.manager.')
    ->group(function () {
        Route::get('/seo', [SeoManagerController::class, 'index'])
            ->middleware('permission:seo.view');

        Route::post('/seo/sites', [SeoManagerController::class, 'storeSite'])
            ->middleware('permission:seo.update')
            ->name('sites.store');

        Route::put('/seo/pages/{seoPage}', [SeoManagerController::class, 'savePage'])
            ->middleware('permission:seo.update')
            ->name('pages.save');
    });

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::post('/locale', function (\Illuminate\Http\Request $request) {
            $request->validate(['locale' => ['required', 'in:en,hi']]);
            session(['admin_locale' => $request->input('locale')]);
            return back();
        })->name('admin.locale.update');
    });
