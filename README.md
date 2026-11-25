# Kirbyblock Divider
A divider block for Kirby's PageWizard: a line between two sections – solid, dashed, dotted, double, fading or wavy, optionally with a circle, diamond, orbit or a short text in its centre. Stroke, opacity, width, alignment and an effect (run in, glow, flowing) per block; the colours per colour variant and the widths in the Project Wizard.

## Modify

**Override CSS:**
- Patch files: `site/patches/css/kirbyblock-divider/_styles.css` (inactive)
- Remove underscore to activate: `styles.css` (active, replaces plugin CSS)

**Override snippet:**
- Stub file: `site/snippets/blocks/_pwdivider.php` (inactive)
- Remove underscore to activate: `pwdivider.php` (active, replaces plugin snippet)

## Tech Note

- `.kirbyup` → Triggers automatic build via KirbyUp
- `.stub` → Generates underscore copies for customization
- `src/js/05_pwdivider.js` → The line running in once in view (concatenated into the site's JS)
