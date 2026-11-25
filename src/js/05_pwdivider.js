/**
 * The divider's line running in (kirbyblock-divider, effect "draw"): waits
 * drawn back until it comes into view, then runs in once. Without motion
 * wishes, or without IntersectionObserver, it stands at once.
 */
(function () {
	function start() {
		var lines = Array.prototype.slice.call(document.querySelectorAll('.pw-divider[data-line-effect="draw"]'));
		var still = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (!lines.length || still || !('IntersectionObserver' in window)) return;
		var seen = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) return;
				entry.target.setAttribute('data-line-play', 'run');
				seen.unobserve(entry.target);
			});
		}, { threshold: 0.5 });
		lines.forEach(function (line) {
			line.setAttribute('data-line-play', 'wait');
			seen.observe(line);
		});
	}

	if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
	else start();
})();
