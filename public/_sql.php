<?php
/**
 * Lucky Satta - Public/Admin Database Bridge
 *
 * IMPORTANT:
 * The public pages use the SAME Laravel application, Eloquent models and
 * database configuration as the Admin panel. This avoids maintaining a
 * second/manual PDO implementation that can point at a different database.
 *
 * No public UI is changed here. This file only prepares the variables used by
 * the existing legacy public templates.
 */

declare(strict_types=1);

date_default_timezone_set('Asia/Kolkata');

/* --------------------------------------------------------------------------
 | Bootstrap Laravel exactly enough to use the same Eloquent/DB configuration
 | as the Admin panel.
 * -------------------------------------------------------------------------- */

$laravelBase = __DIR__;
$bootstrapFile = $laravelBase . '/bootstrap/app.php';
$autoloadFile  = $laravelBase . '/vendor/autoload.php';

/* When the public files live in /public, the Laravel project is one level up. */
if (!is_file($bootstrapFile)) {
    $laravelBase = dirname(__DIR__);
    $bootstrapFile = $laravelBase . '/bootstrap/app.php';
    $autoloadFile  = $laravelBase . '/vendor/autoload.php';
}

/* When legacy files are inside a nested public directory. */
if (!is_file($bootstrapFile)) {
    $laravelBase = dirname(__DIR__, 2);
    $bootstrapFile = $laravelBase . '/bootstrap/app.php';
    $autoloadFile  = $laravelBase . '/vendor/autoload.php';
}

if (!is_file($autoloadFile) || !is_file($bootstrapFile)) {
    http_response_code(500);
    exit('Laravel application files were not found. Make sure this public site is inside the Laravel project and vendor/ is present.');
}

try {
    require_once $autoloadFile;

    /** @var \Illuminate\Foundation\Application $app */
    $app = require $bootstrapFile;

    /*
     * Laravel's normal HTTP Kernel performs these bootstrappers before the
     * Admin controllers execute. We do the same here because this legacy
     * template is rendered directly instead of through a Laravel controller.
     */
    if (method_exists($app, 'bootstrapWith')) {
        $app->bootstrapWith([
            \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
            \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
            \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
            \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
            \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
            \Illuminate\Foundation\Bootstrap\BootProviders::class,
        ]);
    }

    if (method_exists($app, 'boot') && ! $app->isBooted()) {
        $app->boot();
    }

    /* Make DB/model services available exactly like a normal Laravel request. */
    $db = $app->make('db');

    /* ----------------------------------------------------------------------
     | Compatibility helpers used by existing public files.
     * ---------------------------------------------------------------------- */

    if (!function_exists('ls_env')) {
        function ls_env(string $key, ?string $default = null): ?string
        {
            $value = getenv($key);
            return ($value !== false && $value !== '') ? $value : $default;
        }
    }

    if (!function_exists('ls_pdo')) {
        function ls_pdo(): PDO
        {
            static $pdo = null;

            if ($pdo instanceof PDO) {
                return $pdo;
            }

            /* This fallback is only for old helper calls. Laravel is the
             * primary connection used above and by all actual data fetching. */
            $host = (string) ls_env('DB_HOST', '127.0.0.1');
            $port = (string) ls_env('DB_PORT', '3306');
            $name = (string) ls_env('DB_DATABASE', '');
            $user = (string) ls_env('DB_USERNAME', '');
            $pass = (string) ls_env('DB_PASSWORD', '');

            $pdo = new PDO(
                "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );

            return $pdo;
        }
    }

    if (!function_exists('ls_has_table')) {
        function ls_has_table(string $table): bool
        {
            try {
                return \Illuminate\Support\Facades\Schema::hasTable($table);
            } catch (Throwable) {
                return false;
            }
        }
    }

    if (!function_exists('ls_rows')) {
        function ls_rows(string $table): array
        {
            try {
                if (!\Illuminate\Support\Facades\Schema::hasTable($table)) {
                    return [];
                }

                return \Illuminate\Support\Facades\DB::table($table)->get()->map(
                    static fn ($row) => (array) $row
                )->all();
            } catch (Throwable $e) {
                error_log("Public Laravel DB read failed for {$table}: {$e->getMessage()}");
                return [];
            }
        }
    }

    if (!function_exists('ls_first')) {
        function ls_first(array $row, array $keys, mixed $default = ''): mixed
        {
            foreach ($keys as $key) {
                if (array_key_exists($key, $row) && $row[$key] !== null && $row[$key] !== '') {
                    return $row[$key];
                }
            }

            return $default;
        }
    }

    if (!function_exists('ls_bool')) {
        function ls_bool(mixed $value): bool
        {
            if (is_bool($value)) {
                return $value;
            }

            return in_array(
                strtolower(trim((string) $value)),
                ['1', 'true', 'yes', 'on', 'active', 'published'],
                true
            );
        }
    }

    /* ----------------------------------------------------------------------
     | Import the SAME models used by Admin controllers.
     * ---------------------------------------------------------------------- */

    $Game       = \App\Models\Game::class;
    $GameResult = \App\Models\GameResult::class;
    $Blog       = \App\Models\Blog::class;
    $Faq        = \App\Models\Faq::class;
    $Khaiwal    = \App\Models\Khaiwal::class;
    $Setting    = \App\Models\Setting::class;

    /* ----------------------------------------------------------------------
     | SETTINGS
     * ---------------------------------------------------------------------- */

    $settings = [];

    /** @var \Illuminate\Database\Eloquent\Collection $settingRows */
    $settingRows = $Setting::query()
        ->orderBy('key')
        ->get();

    foreach ($settingRows as $setting) {
        $value = $setting->typed_value;
        $key = (string) $setting->key;

        $settings[$key] = $value;

        if (str_contains($key, '.')) {
            $shortKey = substr($key, strrpos($key, '.') + 1);
            if (!array_key_exists($shortKey, $settings)) {
                $settings[$shortKey] = $value;
            }
        }
    }

    /* ----------------------------------------------------------------------
     | GAMES + CITIES + RESULTS
     * ---------------------------------------------------------------------- */

    $todayDate = now()->timezone('Asia/Kolkata')->toDateString();
    $yesterdayDate = now()->timezone('Asia/Kolkata')->subDay()->toDateString();

    $gameCollection = $Game::query()
        ->with([
            'city',
            'results' => function ($query) {
                $query
                    ->orderByDesc('result_date')
                    ->orderByDesc('id');
            },
        ])
        ->where('active', true)
        ->orderBy('display_order')
        ->orderBy('name')
        ->get();

    $games = [];
    $gameIdToSlug = [];
    $gameIdToLegacy = [];
    $gameAlias = [];

    $formatTime = static function ($value): string {
        if ($value === null || $value === '') {
            return '';
        }

        try {
            if ($value instanceof \Carbon\CarbonInterface) {
                return $value->format('h:i A');
            }

            $text = trim((string) $value);
            if (preg_match('/^\d{1,2}:\d{2}/', $text)) {
                $parts = explode(':', $text);
                $hour = (int) $parts[0];
                $minute = (int) $parts[1];
                return date('h:i A', mktime($hour, $minute, 0));
            }

            $timestamp = strtotime($text);
            return $timestamp !== false ? date('h:i A', $timestamp) : $text;
        } catch (Throwable) {
            return (string) $value;
        }
    };

    $resultValue = static function ($result): string {
        $jodi = trim((string) ($result->jodi ?? ''));
        if ($jodi !== '') {
            return $jodi;
        }

        $resultText = trim((string) ($result->result ?? ''));
        if ($resultText !== '') {
            return $resultText;
        }

        return '';
    };

    foreach ($gameCollection as $game) {
        $slug = strtolower(trim((string) $game->slug));
        $legacyId = strtolower(trim((string) ($game->legacy_id ?? '')));

        if ($slug === '') {
            continue;
        }

        $gameData = [
            'id' => (string) $game->id,
            'legacy_id' => $legacyId,
            'city_id' => (string) ($game->city_id ?? ''),
            'name' => (string) $game->name,
            'slug' => $slug,
            'open_time' => $formatTime($game->open_time),
            'close_time' => $formatTime($game->close_time),
            'chart_url' => (string) ($game->chart_url ?: 'chart.php?game=' . rawurlencode($slug)),
            'prev_result' => '',
            'result' => '',
            'display_order' => (int) $game->display_order,
        ];

        $todayResult = null;
        $yesterdayResult = null;
        $latestPreviousResult = null;

        foreach ($game->results as $gameResult) {
            $date = $gameResult->result_date instanceof \Carbon\CarbonInterface
                ? $gameResult->result_date->toDateString()
                : substr((string) $gameResult->result_date, 0, 10);

            $status = strtolower((string) ($gameResult->status ?? 'published'));

            if ($status === 'cancelled') {
                continue;
            }

            $value = $resultValue($gameResult);
            if ($value === '') {
                continue;
            }

            if ($date === $todayDate && $todayResult === null) {
                $todayResult = $value;
            }

            if ($date === $yesterdayDate && $yesterdayResult === null) {
                $yesterdayResult = $value;
            }

            if ($date < $todayDate && $latestPreviousResult === null) {
                $latestPreviousResult = $value;
            }
        }

        $gameData['result'] = $todayResult ?? '';
        $gameData['prev_result'] = $yesterdayResult
            ?? $latestPreviousResult
            ?? '';

        $games[$slug] = $gameData;
        $gameIdToSlug[(string) $game->id] = $slug;

        if ($legacyId !== '') {
            $gameAlias[$legacyId] = $slug;
            $gameIdToLegacy[(string) $game->id] = $legacyId;
        }

        $gameAlias[$slug] = $slug;
    }

    foreach ($gameAlias as $alias => $canonicalSlug) {
        if (isset($games[$canonicalSlug]) && !isset($games[$alias])) {
            $games[$alias] = $games[$canonicalSlug];
        }
    }

    $dailyResults = [];

    foreach ($gameCollection as $game) {
        $slug = strtolower(trim((string) $game->slug));
        if ($slug === '') {
            continue;
        }

        $legacyId = strtolower(trim((string) ($game->legacy_id ?? '')));
        $keys = [$slug];
        if ($legacyId !== '') {
            $keys[] = $legacyId;
        }

        foreach ($game->results as $gameResult) {
            $status = strtolower((string) ($gameResult->status ?? 'published'));
            if ($status === 'cancelled') {
                continue;
            }

            $date = $gameResult->result_date instanceof \Carbon\CarbonInterface
                ? $gameResult->result_date->toDateString()
                : substr((string) $gameResult->result_date, 0, 10);

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                continue;
            }

            $value = $resultValue($gameResult);
            if ($value === '') {
                continue;
            }

            if (preg_match('/^\d{1,2}$/', $value)) {
                $value = str_pad($value, 2, '0', STR_PAD_LEFT);
            }

            foreach ($keys as $key) {
                $dailyResults[$date][$key] = $value;
            }
        }
    }

    ksort($dailyResults);

    $blogs = [];

    $blogCollection = $Blog::query()
        ->with('author')
        ->where('status', 'published')
        ->orderByDesc('published_at')
        ->orderByDesc('id')
        ->get();

    foreach ($blogCollection as $blog) {
        $blogs[] = [
            'id' => (string) $blog->id,
            'title' => (string) $blog->title,
            'slug' => (string) $blog->slug,
            'excerpt' => (string) ($blog->excerpt ?? ''),
            'content' => (string) $blog->content,
            'author' => (string) ($blog->author?->name ?? ''),
            'cover_text' => (string) ($blog->cover_text ?? ''),
            'cover_image' => (string) ($blog->cover_image ?? ''),
            'created_at' => $blog->created_at?->toDateTimeString() ?? '',
            'published_at' => $blog->published_at?->toDateTimeString() ?? ($blog->created_at?->toDateTimeString() ?? ''),
            'featured' => (bool) $blog->featured,
            'published' => true,
        ];
    }

    $homepageBlogs = array_slice($blogs, 0, 3);

    $faqs = [];
    $allGameFaqs = [];

    $faqCollection = $Faq::query()
        ->with('game')
        ->where('active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    foreach ($faqCollection as $faq) {
        $item = [
            'id' => (string) $faq->id,
            'question' => (string) $faq->question,
            'answer' => (string) $faq->answer,
        ];

        if ($faq->game_id !== null) {
            $slug = $gameIdToSlug[(string) $faq->game_id] ?? null;
            if ($slug !== null) {
                $allGameFaqs[$slug][] = $item;
                continue;
            }
        }

        $faqs[] = $item;
    }

    $khaiwals = [];

    $khaiwalCollection = $Khaiwal::query()
        ->where('active', true)
        ->orderBy('display_order')
        ->orderBy('name')
        ->get();

    foreach ($khaiwalCollection as $khaiwal) {
        $schedule = $khaiwal->schedule;
        if (!is_array($schedule)) {
            $schedule = $schedule ? json_decode((string) $schedule, true) : [];
        }
        if (!is_array($schedule)) {
            $schedule = [];
        }

        $khaiwals[] = [
            'id' => (string) $khaiwal->id,
            'legacy_id' => (string) ($khaiwal->legacy_id ?? ''),
            'name' => (string) $khaiwal->name,
            'top_header' => (string) ($khaiwal->top_header ?? ''),
            'cta_text' => (string) ($khaiwal->cta_text ?? ''),
            'whatsapp' => (string) ($khaiwal->whatsapp ?? ''),
            'telegram' => (string) ($khaiwal->telegram ?? ''),
            'schedule' => $schedule,
        ];
    }

    $socials = [];

    $socialWhatsapp = (string) ($settings['social.whatsapp_url'] ?? $settings['whatsapp_url'] ?? '');
    $socialTelegram = (string) ($settings['social.telegram_url'] ?? $settings['telegram_url'] ?? '');

    if ($socialWhatsapp !== '') {
        $socials[] = [
            'type' => 'whatsapp',
            'title' => '',
            'url' => $socialWhatsapp,
            'image' => '',
        ];
    }

    if ($socialTelegram !== '') {
        $socials[] = [
            'type' => 'telegram',
            'title' => '',
            'url' => $socialTelegram,
            'image' => '',
        ];
    }

    $seoBlocks = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('seo_blocks')) {
        $rows = \Illuminate\Support\Facades\DB::table('seo_blocks')
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        foreach ($rows as $row) {
            $seoBlocks[] = [
                'id' => (string) $row->id,
                'title' => (string) ($row->title ?? ''),
                'content' => (string) ($row->content ?? ''),
                'page_type' => (string) ($row->page_type ?? ''),
            ];
        }
    }

    $allGameSeo = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('game_seo_contents')) {
        $rows = \Illuminate\Support\Facades\DB::table('game_seo_contents')
            ->where('active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        foreach ($rows as $row) {
            $slug = $gameIdToSlug[(string) ($row->game_id ?? '')] ?? null;
            if ($slug === null) {
                continue;
            }

            $allGameSeo[$slug][] = [
                'id' => (string) $row->id,
                'title' => (string) ($row->title ?? ''),
                'content' => (string) ($row->content ?? ''),
            ];
        }
    }

    $guesses = [];
    if (\Illuminate\Support\Facades\Schema::hasTable('forum_posts')) {
        $rows = \Illuminate\Support\Facades\DB::table('forum_posts')
            ->where(function ($query) {
                $query->where('status', 'published')->orWhereNull('status');
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        foreach ($rows as $row) {
            $guesses[] = [
                'id' => (string) $row->id,
                'username' => (string) ($row->username ?? 'User'),
                'text' => (string) ($row->content ?? ''),
                'time' => (string) ($row->created_at ?? ''),
            ];
        }
    }

    $whatsappNumber = (string) (
        $settings['social.whatsapp_url']
        ?? $settings['whatsapp_url']
        ?? $settings['whatsapp_number']
        ?? '+91 73788 74037'
    );

    $whatsappCleanDigits = preg_replace('/[^0-9]/', '', $whatsappNumber) ?: '';

    $telegramUrl = (string) (
        $settings['social.telegram_url']
        ?? $settings['telegram_url']
        ?? 'https://t.me'
    );

    $callout1Header = (string) (
        $settings['callout1_header']
        ?? '🙏 नमस्कार साथियों 🙏'
    );

    $callout1Text = (string) (
        $settings['callout1_text']
        ?? 'अपनी गेम का रिजल्ट हमारी वेबसाइट पर लगवाने के लिए संपर्क करें।'
    );

    $callout1Name = (string) (
        $settings['callout1_name']
        ?? '----ARUN BHAI ----'
    );

    $callout1Whatsapp = (string) (
        $settings['callout1_whatsapp']
        ?? $socialWhatsapp
        ?? $whatsappNumber
    );

    $callout1WhatsappClean = preg_replace('/[^0-9]/', '', $callout1Whatsapp) ?: '';

    $callout2Text = (string) (
        $settings['callout2_text']
        ?? 'अगर किसी भी भाई को कोई शिकायत या परेशानी हो, तो कंपनी के मैनेजर से संपर्क करें।'
    );

    $callout2Name = (string) (
        $settings['callout2_name']
        ?? '----ARUN BHAI ----'
    );

    $callout2Subtext = (string) (
        $settings['callout2_subtext']
        ?? 'कृपया हमें व्हाट्सएप या Telegram पर संपर्क करें।'
    );

    $callout2Telegram = (string) (
        $settings['callout2_telegram']
        ?? $telegramUrl
    );

    /* Useful diagnostics without exposing credentials. */
    $publicDataStatus = [
        'laravel_booted' => true,
        'database' => (string) $db->getDatabaseName(),
        'games' => $gameCollection->count(),
        'results' => $gameCollection->sum(static fn ($game) => $game->results->count()),
        'blogs' => count($blogs),
        'faqs' => count($faqs),
        'khaiwals' => count($khaiwals),
    ];

} catch (Throwable $e) {
    http_response_code(500);

    error_log('Lucky Satta public data bridge error: ' . $e->getMessage());

    $message = 'Public site could not load data from the Laravel database.';

    if (filter_var(getenv('APP_DEBUG') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
        $message .= "\n\n" . $e->getMessage();
    }

    exit(nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')));
}
