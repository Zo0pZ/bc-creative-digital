# Changelog

All notable changes to the BC Creative Digital theme are recorded here.
The format follows [Keep a Changelog](https://keepachangelog.com/); this theme
uses [Semantic Versioning](https://semver.org/).

## [1.1.1] — 2026-11-04

### Fixed

- **Stylesheet enqueue version now tracks the theme header.** `BC_CD_VERSION`
  was hard-coded to `1.0.10`, so `style.css` loaded as `?ver=1.0.10` and browsers
  kept serving the stale stylesheet after an update. It now reads
  `wp_get_theme()->get( 'Version' )`, so the cache-busting version always matches
  the `style.css` header — bumping the header is now the only step needed.

## [1.1.0] — 2026-11-04

A homepage conversion pass following a design critique of the landing page. The
critique scored the page 22/32: strong, on-brand visual craft sitting on real
**consistency** and **proof** debt. This release closes the top findings. The
brand system, colours, type and layout were deliberately left untouched — the
look was not the problem.

### Added

- **New `proof` pattern — "The Person & Proof"** (`patterns/proof.php`), placed
  between *Why Me* and the closing *CTA* on the homepage.
  - **Why:** the biggest gap in the critique (a P0). This is a web/SEO
    designer's homepage that showed **no work and no proof**, while its whole
    pitch is *"you deal with me, not a junior."* That promise was made by an
    entirely faceless page.
  - **What it does:** puts a name and a portrait on the page, states an honest
    first-person promise (reply within one working day, no juniors, no jargon,
    rankings protected), and lists **verifiable** credential chips (15+ years,
    regulated industries & big brands, one point of contact, Weston-super-Mare →
    UK-wide). No fabricated testimonials, client names or metrics.
  - **Placeholders:** the portrait is a brand monogram tile — replace it with a
    real photo of Ben (commented in the markup). A commented slot at the bottom
    of the pattern marks where to add real testimonials, client logos or project
    screenshots when available.
- **Focal hero animation:** the signature lime underline under *"Bold digital."*
  now **draws itself in** on load, sequenced after the hero fade-up.
  - **Why:** one authored motion moment that embodies the brand ("Bold Signal" —
    the signal being marked) rather than generic decoration.
  - Fully `prefers-reduced-motion` gated: reduced motion shows the full static
    underline with no movement.
- **`CHANGELOG.md`** (this file).

### Changed

- **Unified the primary call-to-action label** to **"Get my free website
  review"** everywhere it is the primary enquiry action — header, hero, *Why Me*
  band and the closing *CTA* band (previously four different labels: "Discuss
  Your Project", "Get a free website review", "Let's work together").
  - **Why:** a P1. One action wearing four names (in mixed casing, all pointing
    to `/contact/`) diluted the single conversion path and made visitors unsure
    they were the same step. Secondary buttons ("See what I do", "A bit about
    me") keep their own labels.
- **Replaced the hero "stats" row** (`15+` / `Page 1` / `You`, styled as a
  KPI/metric bar) with an honest, non-metric **trust line** of three chips:
  *15+ years' experience · You deal with me, not a junior · Weston-super-Mare,
  working UK-wide*.
  - **Why:** a P1. "Page 1" and "You" are rhetoric, not data; styling them as
    big metric numbers read as padding — or as fake stats — to a skeptical
    visitor at the very top of the page.
- **Reconciled header and footer navigation** so both menus list the same pages.
  **Portfolio** was added to the footer and **Articles** to the header.
  - **Why:** a P2. Previously the blog was unreachable from the header and the
    portfolio unreachable from the footer.
- **Hero eyebrow tagline** order aligned to the canonical brand line
  ("Branding · Websites · SEO") to match the footer and brand record.

### Fixed

- **Footer divider no longer hard-codes a hex.** The separator's inline
  `#2A3052` was removed from markup and moved to a stylesheet rule
  (`rgba(255,255,255,0.10)`), honouring the design system's "never hard-code a
  colour in markup" rule so theming stays centralised.
- New credential/trust chips reference the **`small` font-size preset** instead
  of inline literal sizes, keeping them on the documented type ramp.

### Notes / still open

- Every CTA still routes to the `/contact/` page; an **inline enquiry form** on
  the CTA band was considered but deferred. The new proof section's promise now
  carries the "I'll reply within one working day" reassurance in the meantime.
- Some pre-existing footer micro font-sizes (`0.9rem`, `0.95rem`) remain off the
  documented ramp; they are cosmetic and were left untouched this release.

## [1.0.10] and earlier

Initial BC Creative Digital block theme: full design-token system (light + dark),
self-hosted Nunito / Nunito Sans, homepage patterns (hero, intro, services,
advantage, cta), header/footer parts, page/landing/blog templates, the "BC Dark"
style variation, and auto-branding on activation.
