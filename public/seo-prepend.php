<?php
/**
 * Legacy public-page SEO bootstrap.
 * The page loads _sql.php first; the buffer callback then uses the
 * already-bootstrapped database helpers and injects metadata into <head>.
 */

if (defined('LUCKY_SATTA_SEO_PREPENDED')) {
    return;
}
define('LUCKY_SATTA_SEO_PREPENDED', true);

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
