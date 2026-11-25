<template>
	<!-- the block in the panel: its info bar and the line as chosen (style,
	     centre, width, stroke, opacity – in a neutral colour); a double click
	     opens the block -->
	<div class="pwPreview" data-kirbyblock="divider" @dblclick="open">

		<pwBlockinfo
			:value="$t('kirbyblock-divider.name')"
			:design="'pwdivider'"
			icon="divider"
		/>

		<div class="pw-divider-preview">
			<div
				class="pw-divider"
				:data-line-style="content.linestyle || 'solid'"
				:data-line-center="center"
				:data-line-width="content.linewidth || 'grid'"
				:data-line-align="content.linealign || 'center'"
				:style="{ '--pw-divider-stroke': (content.linestroke || 1) + 'px', '--pw-divider-opacity': (content.lineopacity || 100) / 100 }"
			>
				<span class="pw-divider-line"></span>
				<template v-if="center !== 'none'">
					<span class="pw-divider-center">
						<svg v-if="center === 'circle'" viewBox="0 0 16 16" width="16" height="16"><circle cx="8" cy="8" r="5.5" fill="none" stroke="currentColor" :stroke-width="Math.max(1.5, content.linestroke || 1)" /></svg>
						<svg v-else-if="center === 'diamond'" viewBox="0 0 16 16" width="16" height="16"><path d="M8 1.5 14.5 8 8 14.5 1.5 8Z" fill="currentColor" /></svg>
						<svg v-else-if="center === 'orbit'" viewBox="0 0 28 28" width="28" height="28"><circle cx="14" cy="14" r="9" fill="none" stroke="currentColor" stroke-width="1.4" opacity=".55" /><circle cx="14" cy="14" r="3.2" fill="currentColor" /><circle cx="23" cy="14" r="2.4" fill="currentColor" /></svg>
						<span v-else class="pw-divider-label">{{ content.linelabel }}</span>
					</span>
					<span class="pw-divider-line"></span>
				</template>
			</div>
		</div>

	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue'

export default {
	components: {
		pwBlockinfo
	},
	computed: {
		// (text in the middle without a text: no centre, as on the website)
		center() {
			const center = this.content.linecenter || 'none';
			return center === 'label' && !(this.content.linelabel || '').trim() ? 'none' : center;
		}
	}
}
</script>

<style>
/* the website's line (src/css/styles.css) in the panel's neutral colour */
.pwPreview[data-kirbyblock="divider"] .pw-divider-preview { padding: 1.5rem 1rem; color: var(--color-text-dimmed); }
.pwPreview[data-kirbyblock="divider"] .pw-divider { --s: var(--pw-divider-stroke, 1px); --c: currentColor; display: flex; align-items: center; gap: 1rem; width: 100%; }
.pwPreview[data-kirbyblock="divider"] .pw-divider > * { opacity: var(--pw-divider-opacity, 1); }
.pwPreview[data-kirbyblock="divider"] .pw-divider-line { flex: 1; min-width: 0; height: var(--s); background-position: 0 50%; background-repeat: repeat-x; }
.pwPreview[data-kirbyblock="divider"] .pw-divider-center { flex: none; display: flex; }
.pwPreview[data-kirbyblock="divider"] .pw-divider-label { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.14em; text-transform: uppercase; white-space: nowrap; }
.pwPreview[data-kirbyblock="divider"] .pw-divider[data-line-width="short"] { max-width: 8rem; }
.pwPreview[data-kirbyblock="divider"] .pw-divider[data-line-width="content"] { max-width: 60%; }
.pwPreview[data-kirbyblock="divider"] .pw-divider:is([data-line-width="short"], [data-line-width="content"])[data-line-align="center"] { margin-inline: auto; }
.pwPreview[data-kirbyblock="divider"] .pw-divider:is([data-line-width="short"], [data-line-width="content"])[data-line-align="right"] { margin-left: auto; }
.pwPreview[data-kirbyblock="divider"] [data-line-style="solid"] .pw-divider-line { background: var(--c); }
.pwPreview[data-kirbyblock="divider"] [data-line-style="dashed"] .pw-divider-line { background-image: repeating-linear-gradient(90deg, var(--c) 0 calc(var(--s) * 5), transparent calc(var(--s) * 5) calc(var(--s) * 9)); }
.pwPreview[data-kirbyblock="divider"] [data-line-style="dotted"] .pw-divider-line { background-image: radial-gradient(circle at center, var(--c) 0 calc(var(--s) * .5), transparent calc(var(--s) * .5 + .5px)); background-size: calc(var(--s) * 3) var(--s); }
.pwPreview[data-kirbyblock="divider"] [data-line-style="double"] .pw-divider-line { height: calc(var(--s) * 3 + 2px); background: linear-gradient(var(--c), var(--c)) 0 0 / 100% var(--s) no-repeat, linear-gradient(var(--c), var(--c)) 0 100% / 100% var(--s) no-repeat; }
.pwPreview[data-kirbyblock="divider"] [data-line-style="fade"] .pw-divider-line:first-child { background: linear-gradient(90deg, transparent, var(--c)); }
.pwPreview[data-kirbyblock="divider"] [data-line-style="fade"] .pw-divider-line:last-child { background: linear-gradient(90deg, var(--c), transparent); }
.pwPreview[data-kirbyblock="divider"] [data-line-style="fade"] .pw-divider-line:only-child { background: linear-gradient(90deg, transparent, var(--c) 30%, var(--c) 70%, transparent); }
.pwPreview[data-kirbyblock="divider"] [data-line-style="wavy"] .pw-divider-line { height: calc(var(--s) * 5); background: var(--c); -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='10' viewBox='0 0 20 10'%3E%3Cpath d='M-10 5 Q-5 0 0 5 T10 5 T20 5 T30 5' fill='none' stroke='black' stroke-width='2'/%3E%3C/svg%3E") 0 50% / calc(var(--s) * 10) 100% repeat-x; mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='10' viewBox='0 0 20 10'%3E%3Cpath d='M-10 5 Q-5 0 0 5 T10 5 T20 5 T30 5' fill='none' stroke='black' stroke-width='2'/%3E%3C/svg%3E") 0 50% / calc(var(--s) * 10) 100% repeat-x; }
</style>
