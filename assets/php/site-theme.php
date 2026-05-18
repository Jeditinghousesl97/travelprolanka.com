<?php
require_once __DIR__ . '/theme-settings.php';

if (!isset($cfg) || !is_callable($cfg)) {
    return;
}

$themeSettings = theme_setting_definitions();
$themeValues = [];

foreach ($themeSettings as $key => $meta) {
    $themeValues[$meta['css_var']] = theme_normalize_hex_color($cfg($key, $meta['default']), $meta['default']);
}

[$primaryR, $primaryG, $primaryB] = theme_hex_to_rgb($themeValues['--primary']);
[$darkR, $darkG, $darkB] = theme_hex_to_rgb($themeValues['--dark']);
[$heroTopR, $heroTopG, $heroTopB] = theme_hex_to_rgb($themeValues['--hero-overlay-top-color']);
[$heroMidR, $heroMidG, $heroMidB] = theme_hex_to_rgb($themeValues['--hero-overlay-mid-color']);
[$heroEndR, $heroEndG, $heroEndB] = theme_hex_to_rgb($themeValues['--hero-overlay-end-color']);
$heroTopOpacity = theme_normalize_opacity($cfg('theme_hero_overlay_top_opacity', '0.70'), '0.70');
$heroStartOpacity = theme_normalize_opacity($cfg('theme_hero_overlay_start_opacity', '0.65'), '0.65');
$heroMidOpacity = theme_normalize_opacity($cfg('theme_hero_overlay_mid_opacity', '0.40'), '0.40');
$heroEndOpacity = theme_normalize_opacity($cfg('theme_hero_overlay_end_opacity', '0.25'), '0.25');
?>
    <style id="site-theme-overrides">
        :root {
            <?php foreach ($themeValues as $cssVar => $value): ?>
            <?= htmlspecialchars($cssVar) ?>: <?= htmlspecialchars($value) ?>;
            <?php endforeach; ?>
            --grad-primary: linear-gradient(135deg, <?= htmlspecialchars($themeValues['--primary']) ?> 0%, <?= htmlspecialchars($themeValues['--primary-light']) ?> 100%);
            --grad-dark: linear-gradient(135deg, <?= htmlspecialchars($themeValues['--dark']) ?> 0%, <?= htmlspecialchars($themeValues['--dark-2']) ?> 100%);
            --grad-hero: linear-gradient(to bottom, rgba(<?= $darkR ?>,<?= $darkG ?>,<?= $darkB ?>,0.55) 0%, rgba(<?= $primaryR ?>,<?= $primaryG ?>,<?= $primaryB ?>,0.35) 100%);
            --hero-overlay-top: rgba(<?= $heroTopR ?>,<?= $heroTopG ?>,<?= $heroTopB ?>,<?= $heroTopOpacity ?>);
            --hero-overlay-main-start: rgba(<?= $heroTopR ?>,<?= $heroTopG ?>,<?= $heroTopB ?>,<?= $heroStartOpacity ?>);
            --hero-overlay-main-mid: rgba(<?= $heroMidR ?>,<?= $heroMidG ?>,<?= $heroMidB ?>,<?= $heroMidOpacity ?>);
            --hero-overlay-main-end: rgba(<?= $heroEndR ?>,<?= $heroEndG ?>,<?= $heroEndB ?>,<?= $heroEndOpacity ?>);
            --shadow-xs: 0 1px 4px rgba(<?= $primaryR ?>,<?= $primaryG ?>,<?= $primaryB ?>,0.08);
            --shadow-sm: 0 2px 12px rgba(<?= $primaryR ?>,<?= $primaryG ?>,<?= $primaryB ?>,0.10);
            --shadow-md: 0 6px 28px rgba(<?= $primaryR ?>,<?= $primaryG ?>,<?= $primaryB ?>,0.14);
            --shadow-lg: 0 12px 45px rgba(<?= $primaryR ?>,<?= $primaryG ?>,<?= $primaryB ?>,0.18);
        }
    </style>
