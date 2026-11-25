<?php

// The divider's choices as toggles (icons from the panel's set, the name as tooltip)
$toggles = fn(string $prop, array $options, array $icons = []) => array_map(fn($value) => array_filter([
	'value' => $value,
	'icon'  => $icons[$value] ?? null,
	'text'  => ['*' => 'kirbyblock-divider.' . $prop . '.' . $value],
]), $options);

return [
	'blocks/pwdivider' => pwBlueprint::main('pwdivider', function ($cfg) use ($toggles) {
		$fields  = $cfg['fields'];
		$options = $cfg['field-options']['divider'] ?? [];
		// start values from the Project Wizard (settings.json content.divider)
		$start = fn(string $prop, $fallback) => $fields[$prop . '-divider'] ?? $fallback;
		return [
			'name'               => 'kirbyblock-divider.name',
			'icon'               => 'divider',
			// no tagline, heading or text: the line is the block
			'noContentHeader'    => true,
			'contentFields'      => [
				'lineStyle' => [
					'type'     => 'toggles',
					'label'    => 'kirbyblock-divider.style',
					'default'  => $start('linestyle', 'solid'),
					'required' => true,
					'options'  => $toggles('linestyle', $options['linestyle'] ?? ['solid', 'dashed', 'dotted', 'double', 'fade', 'wavy']),
				],
				'lineCenter' => [
					'type'     => 'toggles',
					'label'    => 'kirbyblock-divider.center',
					'default'  => $start('linecenter', 'none'),
					'required' => true,
					'options'  => $toggles('linecenter', $options['linecenter'] ?? ['none', 'circle', 'diamond', 'orbit', 'label']),
				],
				'lineLabel' => [
					'type'      => 'text',
					'label'     => 'kirbyblock-divider.label',
					'maxlength' => 60,
					'when'      => ['lineCenter' => 'label'],
				],
				'lineColor' => [
					'type'     => 'toggles',
					'label'    => 'kirbyblock-divider.color',
					'help'     => 'kirbyblock-divider.color.help',
					'default'  => $start('linecolor', 'line'),
					'required' => true,
					'width'    => '1/2',
					'options'  => $toggles('linecolor', $options['linecolor'] ?? ['line', 'gradient']),
				],
				'lineEffect' => [
					'type'     => 'toggles',
					'label'    => 'kirbyblock-divider.effect',
					'help'     => 'kirbyblock-divider.effect.help',
					'default'  => $start('lineeffect', 'none'),
					'required' => true,
					'width'    => '1/2',
					'options'  => $toggles('lineeffect', $options['lineeffect'] ?? ['none', 'draw', 'glow', 'flow']),
				],
				'lineStroke' => [
					'type'    => 'range',
					'label'   => 'kirbyblock-divider.stroke',
					'default' => (int) $start('linestroke', 1),
					'min'     => 1,
					'max'     => 8,
					'step'    => 1,
					'after'   => 'px',
					'width'   => '1/2',
				],
				'lineOpacity' => [
					'type'    => 'range',
					'label'   => 'kirbyblock-divider.opacity',
					'help'    => 'kirbyblock-divider.opacity.help',
					'default' => (int) $start('lineopacity', 100),
					'min'     => 10,
					'max'     => 100,
					'step'    => 5,
					'after'   => '%',
					'width'   => '1/2',
				],
				'lineWidth' => [
					'type'     => 'toggles',
					'label'    => 'kirbyblock-divider.width',
					'default'  => $start('linewidth', 'grid'),
					'required' => true,
					'width'    => '1/2',
					'options'  => $toggles('linewidth', $options['linewidth'] ?? ['short', 'content', 'grid', 'full']),
				],
				'lineAlign' => [
					'type'     => 'toggles',
					'label'    => 'kirbyblock-divider.align',
					'default'  => $start('align', 'center'),
					'required' => true,
					'help'     => 'kirbyblock-divider.align.help',
					'width'    => '1/2',
					'options'  => $toggles('align', $options['align'] ?? ['left', 'center', 'right'], ['left' => 'text-left', 'center' => 'text-center', 'right' => 'text-right']),
				],
			],
		];
	}),
];
