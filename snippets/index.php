<?php

// Config
$config   = pwConfig::load('pwdivider');
$settings = $config['content'];
$fields   = $config['fields'];
$options  = $config['field-options']['divider'] ?? [];

// The block's choices (an unknown value: the start value from the Project Wizard)
$choice = function (string $key, string $prop, string $fallback) use ($block, $fields, $options) {
	$value = $block->content()->get($key)->value();
	$start = $fields[$prop . '-divider'] ?? $fallback;
	return in_array($value, $options[$prop] ?? [$value], true) && $value !== '' && $value !== null ? $value : $start;
};
$style   = $choice('lineStyle', 'linestyle', 'solid');
$center  = $choice('lineCenter', 'linecenter', 'none');
$color   = $choice('lineColor', 'linecolor', 'line');
$effect  = $choice('lineEffect', 'lineeffect', 'none');
$width   = $choice('lineWidth', 'linewidth', 'grid');
$align   = $choice('lineAlign', 'align', 'center');
$stroke  = max(1, min(8, (int) ($block->content()->lineStroke()->or($fields['linestroke-divider'] ?? 1)->value())));
$opacity = max(10, min(100, (int) ($block->content()->lineOpacity()->or($fields['lineopacity-divider'] ?? 100)->value())));
$label   = trim((string) $block->content()->lineLabel()->value());
if ($center === 'label' && $label === '') $center = 'none';

// Custom Background
pwSnippet::customCss($block);

// Section + Grid open
echo pwSnippet::sectionOpen('divider', $block, $settings);
echo pwSnippet::gridOpen($block);
?>
<div class="pw-divider" role="separator"
	data-line-style="<?= $style ?>" data-line-center="<?= $center ?>" data-line-color="<?= $color ?>"
	data-line-effect="<?= $effect ?>" data-line-width="<?= $width ?>" data-line-align="<?= $align ?>"
	style="--pw-divider-stroke: <?= $stroke ?>px; --pw-divider-opacity: <?= $opacity / 100 ?>;">
	<span class="pw-divider-line"></span>
	<?php if ($center !== 'none'): ?>
	<span class="pw-divider-center"<?= $center === 'label' ? '' : ' aria-hidden="true"' ?>>
		<?php if ($center === 'circle'): ?><svg viewBox="0 0 16 16" width="16" height="16"><circle cx="8" cy="8" r="5.5" fill="none" stroke="currentColor" stroke-width="<?= max(1.5, $stroke) ?>"/></svg>
		<?php elseif ($center === 'diamond'): ?><svg viewBox="0 0 16 16" width="16" height="16"><path d="M8 1.5 14.5 8 8 14.5 1.5 8Z" fill="currentColor"/></svg>
		<?php elseif ($center === 'orbit'): ?><svg viewBox="0 0 28 28" width="28" height="28"><circle cx="14" cy="14" r="9" fill="none" stroke="currentColor" stroke-width="<?= max(1.2, $stroke * .7) ?>" opacity=".55"/><circle cx="14" cy="14" r="3.2" fill="currentColor"/><g class="pw-divider-satellite"><circle cx="23" cy="14" r="2.4" fill="currentColor"/></g></svg>
		<?php else: ?><span class="pw-divider-label"><?= esc($label) ?></span>
		<?php endif ?>
	</span>
	<span class="pw-divider-line"></span>
	<?php endif ?>
</div>
<?php
// Close
echo pwSnippet::gridClose();
echo pwSnippet::sectionClose();
