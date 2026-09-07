<?php
/*
 * Reusable SEO head for legacy public PHP pages.
 * _sql.php is loaded by those pages before this helper.
 */

$seoPageKey = $seoPageKey ?? match (basename($_SERVER['SCRIPT_NAME'] ?? '')) {
    'chart.php' => 'chart',
    'blog-list.php' => 'blog-list',
    'blog-detail.php' => 'blog-detail',
    'privacy-policy.php' => 'privacy-policy',
    'terms-and-conditions.php' => 'terms',
    'disclaimer.php' => 'disclaimer',
    'contact.php' => 'contact',
    default => 'home',
};

$host = strtolower((string)($_SERVER['HTTP_HOST'] ?? ''));
$host = preg_replace('/^www\./', '', $host);
$pdo = null;
$seo = null;
$site = null;

try {
    if (function_exists('ls_pdo')) {
        $pdo = ls_pdo();

        // Keep the domain lookup index-friendly. The host is normalized first,
        // so LOWER(domain) is unnecessary and would make a normal index harder
        // for MySQL/MariaDB to use.
        $siteStmt = $pdo->prepare(
            'SELECT id, name, domain, scheme, logo_url, organization_name, same_as
             FROM seo_sites
             WHERE active = 1 AND domain = ?
             LIMIT 1'
        );
        $siteStmt->execute([$host]);
        $site = $siteStmt->fetch(PDO::FETCH_ASSOC) ?: null;

        if (!$site) {
            $siteStmt = $pdo->query(
                'SELECT id, name, domain, scheme, logo_url, organization_name, same_as
                 FROM seo_sites
                 WHERE active = 1
                 ORDER BY id
                 LIMIT 1'
            );
            $site = $siteStmt?->fetch(PDO::FETCH_ASSOC) ?: null;
        }

        if ($site) {
            $stmt = $pdo->prepare(
                'SELECT meta_title, meta_description, focus_keyword, secondary_keywords,
                        canonical_url, robots, author, og_title, og_description, og_image,
                        twitter_title, twitter_description, twitter_image, schema_type,
                        schema_json, extra_head
                 FROM seo_pages
                 WHERE seo_site_id = ? AND page_key = ?
                 LIMIT 1'
            );
            $stmt->execute([(int)$site['id'], $seoPageKey]);
            $seo = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        }
    }
} catch (Throwable $e) {
    error_log('Legacy SEO head lookup failed: ' . $e->getMessage());
}

$siteName = (string)($site['name'] ?? ($siteName ?? 'Lucky Satta'));
$baseUrl = rtrim((string)($site['scheme'] ?? 'https') . '://' . ($site['domain'] ?? ($siteDomain ?? $host)), '/');
$currentUrl = $baseUrl . (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$title = (string)($seo['meta_title'] ?? ($pageTitle ?? ($siteName . ' Result')));
$description = (string)($seo['meta_description'] ?? ('Latest ' . $siteName . ' results, charts and updates.'));
$canonical = (string)($seo['canonical_url'] ?? $currentUrl);
$robots = (string)($seo['robots'] ?? 'index,follow');
$keywords = trim((string)($seo['focus_keyword'] ?? '') . ', ' . (string)($seo['secondary_keywords'] ?? ''), ' ,');
$author = (string)($seo['author'] ?? '');
$ogTitle = (string)($seo['og_title'] ?? $title);
$ogDescription = (string)($seo['og_description'] ?? $description);
$ogImage = (string)($seo['og_image'] ?? ($site['logo_url'] ?? ''));
$twitterTitle = (string)($seo['twitter_title'] ?? $title);
$twitterDescription = (string)($seo['twitter_description'] ?? $description);
$twitterImage = (string)($seo['twitter_image'] ?? $ogImage);
$schema = null;
if (!empty($seo['schema_json'])) {
    $schema = json_decode((string)$seo['schema_json'], true);
}

$organizationSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    '@id' => $baseUrl . '/#organization',
    'name' => (string)($site['organization_name'] ?? $siteName),
    'url' => $baseUrl . '/',
];
if (!empty($site['logo_url'])) {
    $organizationSchema['logo'] = ['@type' => 'ImageObject', 'url' => $site['logo_url']];
}
if (!empty($site['same_as'])) {
    $sameAs = json_decode((string)$site['same_as'], true);
    if (is_array($sameAs)) $organizationSchema['sameAs'] = array_values(array_filter($sameAs));
}
?>
<meta name="description" content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($keywords !== ''): ?><meta name="keywords" content="<?= htmlspecialchars($keywords, ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
<?php if ($author !== ''): ?><meta name="author" content="<?= htmlspecialchars($author, ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
<link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta name="robots" content="<?= htmlspecialchars($robots, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($ogImage !== ''): ?><meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($twitterTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($twitterDescription, ENT_QUOTES, 'UTF-8') ?>">
<?php if ($twitterImage !== ''): ?><meta name="twitter:image" content="<?= htmlspecialchars($twitterImage, ENT_QUOTES, 'UTF-8') ?>"><?php endif; ?>
<script type="application/ld+json"><?= json_encode($schema ?: [
    '@context' => 'https://schema.org',
    '@type' => ($seo['schema_type'] ?? 'WebPage'),
    'name' => $title,
    'description' => $description,
    'url' => $canonical,
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($organizationSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>
<?php if (!empty($seo['extra_head'])): ?>
<?= $seo['extra_head'] ?>
<?php endif; ?>
