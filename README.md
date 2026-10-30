# BC Creative Digital — WordPress block theme

A Full Site Editing (block) theme for **bencoetzee.co.uk**, built from the BC Creative Digital
design system: electric blue `#2b3bff`, acid-lime accent `#c6f432`, ink-navy `#12142b`,
self-hosted **Nunito** (display) & **Nunito Sans** (text), rounded corners and soft
brand-tinted shadows.

**Branding · Websites · SEO.**

---

## Install (recommended: preview first)

1. In your WordPress dashboard go to **Appearance → Themes → Add New → Upload Theme**.
2. Choose **`bc-creative-digital.zip`** and click **Install Now**.
3. Click **Live Preview** (not Activate yet) to see it against your real content.
4. When you're happy, click **Activate**.

> If your host blocks theme uploads, install it via SFTP/your file manager:
> unzip the folder into `wp-content/themes/` so you have
> `wp-content/themes/bc-creative-digital/style.css`, then activate it in **Appearance → Themes**.

Your posts, pages and menus are **not touched** — a theme only changes how the site looks.
Nothing is deleted. You can switch back to your old theme at any time.

## What happens on activation

- The **site logo** and **favicon (site icon)** are set automatically from the bundled
  brand assets — *only if you don't already have them set*. Existing choices are never overwritten.
- The **homepage** uses the new `front-page` template: a full BC Creative Digital landing
  page (hero → services → enterprise-standards band → selected work → CTA). This takes
  precedence over any static front page while this theme is active.

## After activating — a few things to check in the Site Editor

Go to **Appearance → Editor**:

- **Navigation** (in the Header): the menu uses `Home / Portfolio / About / Contact` as
  custom links. If your page slugs differ, swap them for your real pages.
- **Selected work** grid: the six project cards reuse names pulled from your current site
  as placeholders (The Heritage, Fat Goose Catering, Visual Statements, Bottled Lightning,
  William Richard Palmer, The Oak and Glass). Replace the text and drop in real screenshots
  under **Editor → Patterns → BC Creative Digital → Featured Work grid**.
- **Dark mode:** a **"BC Dark"** style variation is included — **Editor → Styles →
  Browse styles** to try it.
- **Contact details** in the footer (email, phone, address) are pre-filled — confirm they're current.

## Editing the homepage content

The homepage sections are editable **patterns**. Open **Appearance → Editor → Templates →
Front Page**, or edit the individual patterns under **Editor → Patterns → BC Creative Digital**:
*Home Hero, Services Grid, Why — Enterprise Standards band, Featured Work grid, CTA band*.

## What's inside

```
bc-creative-digital/
├── style.css            Theme header + interaction polish (electric hover, card lift, lime ticks)
├── theme.json           All design tokens → colours, fonts, spacing, radius, shadows, motion
├── functions.php        Enqueue, supports, pattern category, Pill button style, auto-brand on activate
├── screenshot.png       Theme preview
├── assets/
│   ├── fonts/           Self-hosted Nunito & Nunito Sans (woff2) — no Google Fonts calls
│   └── images/          Logo, mark, favicons
├── templates/           front-page, index, page, page-wide, page-landing, single, archive, search, 404
├── parts/               header, footer
├── patterns/            hero, services, why, portfolio, cta
└── styles/              bc-dark.json (dark style variation)
```

## Design tokens

- **Colour:** full light + dark palette (surface / ink / brand / accent / functional), all as
  editor presets. Never hard-code a hex — the dark variation inherits automatically.
- **Type:** Nunito ExtraBold for display/headings, Nunito Sans for body. Fluid display sizes.
- **Spacing:** 4px grid (presets 2XS → 5XL). **Radius:** 12/16/24px, pill. **Shadows:** soft,
  navy-tinted, plus the signature electric `shadow-brand` under primary CTAs.

## Requirements

- WordPress **6.6+**, PHP **7.4+**.

Version 1.0.0 · Built for Ben Coetzee.
