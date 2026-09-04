<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\GameResultController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TodayResultController;
use App\Http\Controllers\Admin\SeoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GamePageController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\ChartController2;
use App\Http\Controllers\Admin\ScraperController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\KhaiwalController;
use App\Http\Controllers\Admin\SeoContentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\LuckyNumberController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\SchedulerController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get(
    '/game/{game:slug}',
    [GamePageController::class, 'show']
)->name('game.show');
/*
|--------------------------------------------------------------------------
| Public Chart Routes
|--------------------------------------------------------------------------
*/

Route::get(
    '/chart',
    [ChartController::class, 'index']
)->name('chart');

Route::get(
    '/chart/{game}/{year}/{month}',
    [ChartController::class, 'index']
)
    ->where('game', '[a-zA-Z0-9-]+')
    ->where('year', '[0-9]{4}')
    ->where('month', '0?[1-9]|1[0-2]')
    ->name('chart.month');

Route::get(
    '/chart/{game}/{year?}',
    [ChartController::class, 'index']
)
    ->where('game', '[a-zA-Z0-9-]+')
    ->where('year', '[0-9]{4}')
    ->name('chart.game');

Route::get(
    '/chart.php',
    [ChartController::class, 'index']
)->name('chart.legacy');
// Route::get(
//     '/chart',
//     [ChartController::class, 'index']
// )->name('chart');

// Route::get(
//     '/chart/{game}/{year?}',
//     [ChartController::class, 'index']
// )
//     ->where('game', '[a-zA-Z0-9-]+')
//     ->where('year', '[0-9]{4}')
//     ->name('chart.game');

//     Route::get(
//     '/chart.php',
//     [ChartController::class, 'index']
// )->name('chart.legacy');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', [
            DashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Cities
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'cities',
            CityController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Games
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'games',
            GameController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Today's Results
        |--------------------------------------------------------------------------
        |
        | These MUST come before /results/{result}
        |
        */

        /*
|--------------------------------------------------------------------------
| Khaiwals
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Forum
|--------------------------------------------------------------------------
*/

Route::get(
    '/forum',
    [ForumController::class, 'index']
)
    ->middleware('permission:forum.view')
    ->name('forum.index');

Route::get(
    '/forum/{forumPost}',
    [ForumController::class, 'show']
)
    ->middleware('permission:forum.view')
    ->name('forum.show');

Route::put(
    '/forum/{forumPost}',
    [ForumController::class, 'update']
)
    ->middleware('permission:forum.update')
    ->name('forum.update');

Route::delete(
    '/forum/{forumPost}',
    [ForumController::class, 'destroy']
)
    ->middleware('permission:forum.delete')
    ->name('forum.destroy');


/*
|--------------------------------------------------------------------------
| Cache
|--------------------------------------------------------------------------
*/

Route::get(
    '/cache',
    [CacheController::class, 'index']
)
    ->middleware('permission:cache.view')
    ->name('cache.index');

Route::post(
    '/cache/clear',
    [CacheController::class, 'clear']
)
    ->middleware('permission:cache.clear')
    ->name('cache.clear');


/*
|--------------------------------------------------------------------------
| Scheduler
|--------------------------------------------------------------------------
*/

Route::get(
    '/scheduler',
    [SchedulerController::class, 'index']
)
    ->middleware('permission:scheduler.view')
    ->name('scheduler.index');

Route::post(
    '/scheduler/run',
    [SchedulerController::class, 'run']
)
    ->middleware('permission:scheduler.run')
    ->name('scheduler.run');

Route::get(
    '/lucky-numbers',
    [LuckyNumberController::class, 'index']
)
    ->middleware('permission:lucky-numbers.view')
    ->name('lucky-numbers.index');

Route::put(
    '/lucky-numbers',
    [LuckyNumberController::class, 'update']
)
    ->middleware('permission:lucky-numbers.update')
    ->name('lucky-numbers.update');

Route::post(
    '/lucky-numbers/scrape',
    [LuckyNumberController::class, 'scrapeNow']
)
    ->middleware('permission:lucky-numbers.update')
    ->name('lucky-numbers.scrape');
// Blogs
Route::get('/blogs', [BlogController::class, 'index'])
    ->middleware('permission:blogs.view')
    ->name('blogs.index');

Route::get('/blogs/create', [BlogController::class, 'create'])
    ->middleware('permission:blogs.create')
    ->name('blogs.create');

Route::post('/blogs', [BlogController::class, 'store'])
    ->middleware('permission:blogs.create')
    ->name('blogs.store');

Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])
    ->middleware('permission:blogs.update')
    ->name('blogs.edit');

Route::put('/blogs/{blog}', [BlogController::class, 'update'])
    ->middleware('permission:blogs.update')
    ->name('blogs.update');

Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])
    ->middleware('permission:blogs.delete')
    ->name('blogs.destroy');

Route::post('/blogs/{blog}/publish', [BlogController::class, 'publish'])
    ->middleware('permission:blogs.publish')
    ->name('blogs.publish');

Route::post('/blogs/{blog}/unpublish', [BlogController::class, 'unpublish'])
    ->middleware('permission:blogs.publish')
    ->name('blogs.unpublish');

Route::post('/blogs/{blog}/toggle-featured', [BlogController::class, 'toggleFeatured'])
    ->middleware('permission:blogs.update')
    ->name('blogs.toggle-featured');

Route::get(
    '/social',
    [SocialController::class, 'index']
)
    ->middleware('permission:social.view')
    ->name('social.index');

Route::put(
    '/social',
    [SocialController::class, 'update']
)
    ->middleware('permission:social.update')
    ->name('social.update');
Route::get('/faqs', [FaqController::class, 'index'])
    ->middleware('permission:faqs.view')
    ->name('faqs.index');

Route::get('/faqs/create', [FaqController::class, 'create'])
    ->middleware('permission:faqs.create')
    ->name('faqs.create');

Route::post('/faqs', [FaqController::class, 'store'])
    ->middleware('permission:faqs.create')
    ->name('faqs.store');

Route::get('/faqs/{faq}/edit', [FaqController::class, 'edit'])
    ->middleware('permission:faqs.update')
    ->name('faqs.edit');

Route::put('/faqs/{faq}', [FaqController::class, 'update'])
    ->middleware('permission:faqs.update')
    ->name('faqs.update');

Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])
    ->middleware('permission:faqs.delete')
    ->name('faqs.destroy');

Route::post('/faqs/{faq}/toggle', [FaqController::class, 'toggle'])
    ->middleware('permission:faqs.update')
    ->name('faqs.toggle');

Route::get(
    '/khaiwals',
    [KhaiwalController::class, 'index']
)
    ->middleware('permission:khaiwals.view')
    ->name('khaiwals.index');

Route::get(
    '/khaiwals/create',
    [KhaiwalController::class, 'create']
)
    ->middleware('permission:khaiwals.create')
    ->name('khaiwals.create');

Route::post(
    '/khaiwals',
    [KhaiwalController::class, 'store']
)
    ->middleware('permission:khaiwals.create')
    ->name('khaiwals.store');

Route::get(
    '/khaiwals/{khaiwal}/edit',
    [KhaiwalController::class, 'edit']
)
    ->middleware('permission:khaiwals.update')
    ->name('khaiwals.edit');

Route::put(
    '/khaiwals/{khaiwal}',
    [KhaiwalController::class, 'update']
)
    ->middleware('permission:khaiwals.update')
    ->name('khaiwals.update');

Route::delete(
    '/khaiwals/{khaiwal}',
    [KhaiwalController::class, 'destroy']
)
    ->middleware('permission:khaiwals.delete')
    ->name('khaiwals.destroy');

Route::post(
    '/khaiwals/{khaiwal}/toggle',
    [KhaiwalController::class, 'toggle']
)
    ->middleware('permission:khaiwals.update')
    ->name('khaiwals.toggle');

        Route::get(
            '/results/today',
            [
                TodayResultController::class,
                'index'
            ]
        )->name('results.today');

        Route::post(
            '/results/today',
            [
                TodayResultController::class,
                'update'
            ]
        )->name('results.today.update');

/*
|--------------------------------------------------------------------------
| SEO MANAGEMENT
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| SEO Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/seo',
    [SeoController::class, 'index']
)
    ->middleware('permission:seo.view')
    ->name('seo.index');


/*
|--------------------------------------------------------------------------
| Technical SEO Editor
|--------------------------------------------------------------------------
|
| Example:
| /admin/seo/game/3/edit
|
*/

Route::get(
    '/seo/{type}/{id}/edit',
    [SeoController::class, 'edit']
)
    ->middleware('permission:seo.update')
    ->where('type', 'game')
    ->whereNumber('id')
    ->name('seo.edit');

Route::put(
    '/seo/{type}/{id}',
    [SeoController::class, 'update']
)
    ->middleware('permission:seo.update')
    ->where('type', 'game')
    ->whereNumber('id')
    ->name('seo.update');


/*
|--------------------------------------------------------------------------
| SEO CONTENT
|--------------------------------------------------------------------------
|
| Example:
| /admin/seo/game/3/content
|
*/

Route::get(
    '/seo/game/{game}/content',
    [SeoContentController::class, 'index']
)
    ->middleware('permission:seo.view')
    ->name('seo.content.index');


Route::post(
    '/seo/game/{game}/content',
    [SeoContentController::class, 'storeContent']
)
    ->middleware('permission:seo.update')
    ->name('seo.content.store');


Route::put(
    '/seo/content/{seoContent}',
    [SeoContentController::class, 'updateContent']
)
    ->middleware('permission:seo.update')
    ->name('seo.content.update');


Route::delete(
    '/seo/content/{seoContent}',
    [SeoContentController::class, 'destroyContent']
)
    ->middleware('permission:seo.delete')
    ->name('seo.content.destroy');


Route::post(
    '/seo/content/{seoContent}/toggle',
    [SeoContentController::class, 'toggleContent']
)
    ->middleware('permission:seo.update')
    ->name('seo.content.toggle');


/*
|--------------------------------------------------------------------------
| FAQs
|--------------------------------------------------------------------------
|
| Example:
| /admin/seo/game/3/faq
|
*/

Route::post(
    '/seo/game/{game}/faq',
    [SeoContentController::class, 'storeFaq']
)
    ->middleware('permission:seo.update')
    ->name('seo.faq.store');


Route::put(
    '/seo/faq/{faq}',
    [SeoContentController::class, 'updateFaq']
)
    ->middleware('permission:seo.update')
    ->name('seo.faq.update');


Route::delete(
    '/seo/faq/{faq}',
    [SeoContentController::class, 'destroyFaq']
)
    ->middleware('permission:seo.delete')
    ->name('seo.faq.destroy');


Route::post(
    '/seo/faq/{faq}/toggle',
    [SeoContentController::class, 'toggleFaq']
)
    ->middleware('permission:seo.update')
    ->name('seo.faq.toggle');
/*
|--------------------------------------------------------------------------
| FAQs
|--------------------------------------------------------------------------
*/

Route::post(
    '/seo/game/{game}/faq',
    [SeoContentController::class, 'storeFaq']
)
    ->middleware('permission:seo.update')
    ->name('seo.faq.store');

Route::put(
    '/seo/faq/{faq}',
    [SeoContentController::class, 'updateFaq']
)
    ->middleware('permission:seo.update')
    ->name('seo.faq.update');

Route::delete(
    '/seo/faq/{faq}',
    [SeoContentController::class, 'destroyFaq']
)
    ->middleware('permission:seo.delete')
    ->name('seo.faq.destroy');

Route::post(
    '/seo/faq/{faq}/toggle',
    [SeoContentController::class, 'toggleFaq']
)
    ->middleware('permission:seo.update')
    ->name('seo.faq.toggle');
Route::get(
    '/settings',
    [SettingsController::class, 'index']
)
    ->middleware('permission:settings.view')
    ->name('settings.index');

Route::put(
    '/settings',
    [SettingsController::class, 'update']
)
    ->middleware('permission:settings.update')
    ->name('settings.update');
        /*
        |--------------------------------------------------------------------------
        | Results
        |--------------------------------------------------------------------------
        */
        Route::get(
    '/scraper',
    [ScraperController::class, 'index']
)->middleware('permission:scraper.view')
 ->name('scraper.index');

Route::get(
    '/scraper/create',
    [ScraperController::class, 'create']
)->middleware('permission:scraper.create')
 ->name('scraper.create');

Route::post(
    '/scraper',
    [ScraperController::class, 'store']
)->middleware('permission:scraper.create')
 ->name('scraper.store');

Route::post(
    '/scraper/{source}/run',
    [ScraperController::class, 'run']
)->middleware('permission:scraper.run')
 ->name('scraper.run');

        Route::resource(
            'results',
            GameResultController::class
        );
        Route::get(
    '/charts',
    [ChartController2::class, 'index']
)->middleware('permission:charts.view')
 ->name('charts.index');
Route::post(
    '/charts/week/update',
    [ChartController2::class, 'updateWeek']
)->middleware('permission:charts.update')
 ->name('charts.week.update');
Route::get(
    '/charts/{chartEntry}',
    [ChartController2::class, 'show']
)->middleware('permission:charts.view')
 ->name('charts.show');

Route::get(
    '/charts/{chartEntry}/edit',
    [ChartController2::class, 'edit']
)->middleware('permission:charts.update')
 ->name('charts.edit');

Route::put(
    '/charts/{chartEntry}',
    [ChartController2::class, 'update']
)->middleware('permission:charts.update')
 ->name('charts.update');

Route::get(
    '/seo',
    [SeoController::class, 'index']
)->middleware('permission:seo.view')
 ->name('seo.index');

Route::get(
    '/seo/{type}/{id}/edit',
    [SeoController::class, 'edit']
)->middleware('permission:seo.update')
 ->whereIn('type', ['game', 'blog'])
 ->name('seo.edit');

Route::put(
    '/seo/{type}/{id}',
    [SeoController::class, 'update']
)->middleware('permission:seo.update')
 ->whereIn('type', ['game', 'blog'])
 ->name('seo.update');
        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
  Route::get(
    '/users',
    [UserController::class, 'index']
)->middleware('permission:users.view')
 ->name('users.index');

Route::get(
    '/users/create',
    [UserController::class, 'create']
)->middleware('permission:users.create')
 ->name('users.create');

Route::post(
    '/users',
    [UserController::class, 'store']
)->middleware('permission:users.create')
 ->name('users.store');

Route::get(
    '/users/{user}',
    [UserController::class, 'show']
)->middleware('permission:users.view')
 ->name('users.show');

Route::get(
    '/users/{user}/edit',
    [UserController::class, 'edit']
)->middleware('permission:users.update')
 ->name('users.edit');

Route::put(
    '/users/{user}',
    [UserController::class, 'update']
)->middleware('permission:users.update')
 ->name('users.update');

Route::patch(
    '/users/{user}',
    [UserController::class, 'update']
)->middleware('permission:users.update')
 ->name('users.update');

Route::delete(
    '/users/{user}',
    [UserController::class, 'destroy']
)->middleware('permission:users.delete')
 ->name('users.destroy');
        Route::resource(
            'roles',
            RoleController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'permissions',
            PermissionController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Activity Logs
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/activity-logs',
            [
                ActivityLogController::class,
                'index'
            ]
        )->name('activity-logs.index');

        Route::get(
            '/activity-logs/{activityLog}',
            [
                ActivityLogController::class,
                'show'
            ]
        )->name('activity-logs.show');
    });


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [
            ProfileController::class,
            'edit'
        ]
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [
            ProfileController::class,
            'update'
        ]
    )->name('profile.update');

    Route::delete(
        '/profile',
        [
            ProfileController::class,
            'destroy'
        ]
    )->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
