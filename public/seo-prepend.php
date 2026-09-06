<?php
/**
 * Legacy public-page SEO bootstrap.
 * Generates the shared SEO block and injects it immediately after <head>.
 */

if (defined('LUCKY_SATTA_SEO_PREPENDED')) {
    return;
}
define('LUCKY_SATTA_SEO_PREPENDED', true);

$seoHtml = '';

try {
    ob_start();
    require __DIR__ . '/seo-head.php';
    $seoHtml = ob_get_clean();
} catch (Throwable $e) {
    if (ob_get_level()) {
        ob_end_clean();
    }
    error_log('Legacy SEO prepend failed: ' . $e->getMessage());
}

if ($seoHtml === '') {
    return;
}

ob_start(static function (string $buffer) use ($seoHtml): string {
    $pattern = '/(<head(?:\s[^>]*)?>)/i';
    $replacement = '$1' . "\n" . $seoHtml;
    $updated = preg_replace($pattern, $replacement, $buffer, 1);
    return is_string($updated) ? $updated : $buffer;
});
