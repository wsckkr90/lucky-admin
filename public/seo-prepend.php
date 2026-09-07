<?php
/**
 * Legacy public-page SEO bootstrap.
 *
 * IMPORTANT:
 * Laravel requests are routed through public/index.php and already build
 * their SEO through App\Services\SeoService. Do not start a legacy output
 * buffer or run an extra database lookup for those requests.
 *
 * Direct legacy PHP pages (chart.php, blog-list.php, etc.) still receive the
 * prepend behaviour below.
 */

if (defined('LUCKY_SATTA_SEO_PREPENDED')) {
    return;
}

define('LUCKY_SATTA_SEO_PREPENDED', true);

$scriptName = basename($_SERVER['SCRIPT_NAME'] ?? '');

// Laravel front controller: SEO is handled natively by Laravel.
if ($scriptName === 'index.php') {
    return;
}

ob_start(static function (string $buffer): string {
    if (stripos($buffer, '<head') === false || !function_exists('ls_pdo')) {
        return $buffer;
    }

    try {
        ob_start();
        require __DIR__ . '/seo-head.php';
        $seoHtml = ob_get_clean();

        if ($seoHtml === '') {
            return $buffer;
        }

        $updated = preg_replace(
            '/(<head(?:\s[^>]*)?>)/i',
            '$1' . "\n" . $seoHtml,
            $buffer,
            1
        );

        return is_string($updated) ? $updated : $buffer;
    } catch (Throwable $e) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        error_log('Legacy SEO prepend failed: ' . $e->getMessage());
        return $buffer;
    }
});
