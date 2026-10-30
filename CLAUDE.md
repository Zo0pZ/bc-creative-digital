# CLAUDE.md — BC Creative Digital WordPress theme

Context for Claude Code sessions working in this repository.

## What this is

A WordPress **block (Full Site Editing) theme** for **bencoetzee.co.uk**, built from the
**BC Creative Digital** design system. The repo root *is* the theme (`style.css` + `theme.json`
at top level), so the whole repo zips directly into an installable theme.

Brand line: **Branding · Websites · SEO.**

## Design system (source of truth)

All visual tokens come from the BC Creative Digital design system and live in `theme.json` —
never hard-code a hex, size or radius; reference the preset/custom var so the dark variation
inherits automatically.

- **Colour:** brand `#2b3bff`, accent lime `#c6f432`, ink-navy `#12142b`, plus surface/border
  ramps and functional colours — full light **and** dark values (dark in `styles/bc-dark.json`).
- **Type:** Nunito (ExtraBold 800 display/headings) + Nunito Sans (text), self-hosted in
  `assets/fonts/` — no Google Fonts calls.
- **Spacing:** 4px grid presets. **Radius:** 12/16/24px + pill. **Shadows:** soft navy-tinted,
  plus the signature electric `shadow-brand` under primary CTAs.

## Structure

```
style.css            Theme header + interaction polish (enqueued via functions.php)
theme.json           Design tokens: colours, fonts, spacing, radius, shadows, motion
functions.php        Supports, style enqueue, pattern category, Pill button style, auto-brand on activate
screenshot.png       Theme preview (1200x900)
assets/fonts/        Self-hosted Nunito & Nunito Sans (woff2)
assets/images/       Logo, mark, favicons
templates/           front-page, index, page, page-wide, page-landing, single, archive, search, 404
parts/               header, footer
patterns/            hero, intro, services, advantage, cta  (slug: bc-creative-digital/<name>)
                     Homepage mirrors the live site structure: Hero → Introduction →
                     Core Services (6) → Competitive Advantage (4) → CTA.
styles/              bc-dark.json  (dark style variation)
```

## Conventions

- Block markup in `templates/` and `parts/` is valid WordPress block grammar (`<!-- wp:... -->`).
  Template parts are referenced from templates with `tagName` supplying the semantic element.
- Homepage sections are **patterns** (in `patterns/`), composed into `templates/front-page.html`
  via `<!-- wp:pattern {"slug":"bc-creative-digital/<name>"} /-->`. Pattern slugs must match the
  `Slug:` header in each file.
- Keep styling in `theme.json`; only put interaction/polish CSS that JSON can't express in `style.css`.
- UK English throughout.

## Build / package

Zip the theme folder (repo root) into an installable archive:

```bash
cd ..
zip -rq bc-creative-digital.zip bc-creative-digital -x '*.git*' '*.DS_Store'
```

Install: wp-admin → Appearance → Themes → Add New → Upload Theme → Live Preview → Activate.

## Validate before committing

- `python -m json.tool theme.json` and `styles/bc-dark.json` must parse.
- `php -l functions.php` and `php -l patterns/*.php` must be clean.
- Every `bc-creative-digital/*` slug referenced in `templates/` must exist as a pattern `Slug:`.

## Requirements

WordPress **6.6+**, PHP **7.4+**.
