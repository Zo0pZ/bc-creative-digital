<?php
/**
 * Title: Home Hero
 * Slug: bc-creative-digital/hero
 * Categories: bc-creative-digital, banner
 * Description: Full-width hero with headline, lead, CTAs and a branded trust card.
 * Inserter: true
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"bc-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|110","bottom":"var:preset|spacing|110"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull bc-hero has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--110);padding-bottom:var(--wp--preset--spacing--110)">
<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|80","left":"var:preset|spacing|100"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","letterSpacing":"0.16em","textTransform":"uppercase","fontWeight":"700"}},"textColor":"brand-text"} -->
<p class="has-brand-text-color has-text-color" style="font-size:0.75rem;font-weight:700;letter-spacing:0.16em;text-transform:uppercase">Branding · Websites · SEO</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"typography":{"lineHeight":"1.05"}},"fontSize":"mega"} -->
<h1 class="wp-block-heading has-mega-font-size" style="line-height:1.05">Enterprise-grade digital performance, tailored for your ambition.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"textColor":"ink-muted","fontSize":"large"} -->
<p class="has-ink-muted-color has-text-color has-large-font-size" style="margin-top:var(--wp--preset--spacing--50)">Big-budget capability, scaled for you. I design and build bespoke, high-performing websites that rank, convert and grow — for businesses from local start-ups to corporate enterprises.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--70)">
<!-- wp:button {"backgroundColor":"brand","textColor":"on-brand","style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"0.9rem","bottom":"0.9rem","left":"1.75rem","right":"1.75rem"}}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-on-brand-color has-brand-background-color has-text-color has-background wp-element-button" href="/contact/" style="border-radius:12px;padding-top:0.9rem;padding-right:1.75rem;padding-bottom:0.9rem;padding-left:1.75rem">Discuss your project</a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"brand-text","className":"is-style-outline","style":{"border":{"radius":"12px","width":"2px","color":"var:preset|color|border-strong"},"spacing":{"padding":{"top":"0.9rem","bottom":"0.9rem","left":"1.75rem","right":"1.75rem"}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-brand-text-color has-text-color has-border-color wp-element-button" href="/portfolio/" style="border-color:var(--wp--preset--color--border-strong);border-width:2px;border-radius:12px;padding-top:0.9rem;padding-right:1.75rem;padding-bottom:0.9rem;padding-left:1.75rem">View portfolio</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}},"typography":{"fontSize":"0.8125rem","fontWeight":"700","letterSpacing":"0.04em"}},"textColor":"ink-subtle"} -->
<p class="has-ink-subtle-color has-text-color" style="margin-top:var(--wp--preset--spacing--70);font-size:0.8125rem;font-weight:700;letter-spacing:0.04em">15+ YEARS · UMBRACO &amp; WORDPRESS · GA4 · WCAG ACCESSIBILITY</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%">
<!-- wp:group {"className":"bc-hero-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|70","right":"var:preset|spacing|70"}},"border":{"radius":"24px"},"shadow":"var:preset|shadow|brand"},"backgroundColor":"surface-raised","layout":{"type":"constrained"}} -->
<div class="wp-block-group bc-hero-card has-surface-raised-background-color has-background" style="border-radius:24px;padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--70);box-shadow:var(--wp--preset--shadow--brand)">
<!-- wp:image {"width":"80px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/site-icon-512.png' ) ); ?>" alt="BC Creative Digital mark" style="width:80px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"fontSize":"x-large"} -->
<h3 class="wp-block-heading has-x-large-font-size" style="margin-top:var(--wp--preset--spacing--50)">The independent partner with enterprise standards.</h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"bc-check-list","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}},"typography":{"lineHeight":"2"}},"fontSize":"medium"} -->
<ul class="wp-block-list bc-check-list has-medium-font-size" style="margin-top:var(--wp--preset--spacing--50);line-height:2"><!-- wp:list-item -->
<li>Corporate expertise, direct accountability</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>SEO equity protected through every build</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Measurable growth — rank, convert, grow</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>National reach, local roots</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</section>
<!-- /wp:group -->
