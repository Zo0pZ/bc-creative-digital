<?php
/**
 * BC Creative Digital â€” theme functions.
 *
 * @package BC_Creative_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BC_CD_VERSION', '1.0.6' );

/**
 * Theme supports and editor styles.
 */
function bc_cd_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 160,
			'width'       => 640,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	load_theme_textdomain( 'bc-creative-digital', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'bc_cd_setup' );

/**
 * Enqueue the theme stylesheet on the front end (block themes do not do this automatically).
 */
function bc_cd_enqueue_styles() {
	wp_enqueue_style(
		'bc-creative-digital',
		get_stylesheet_uri(),
		array(),
		BC_CD_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'bc_cd_enqueue_styles' );

/**
 * Register the pattern category used by the homepage sections.
 */
function bc_cd_register_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'bc-creative-digital',
			array( 'label' => __( 'BC Creative Digital', 'bc-creative-digital' ) )
		);
	}
}
add_action( 'init', 'bc_cd_register_pattern_category' );

/**
 * Register a "Pill" style for the Button block.
 */
function bc_cd_register_block_styles() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/button',
			array(
				'name'  => 'pill',
				'label' => __( 'Pill', 'bc-creative-digital' ),
			)
		);
	}
}
add_action( 'init', 'bc_cd_register_block_styles' );

/**
 * Copy a bundled theme asset into the media library and return its attachment ID.
 *
 * @param string $relative_path Path relative to the theme root.
 * @param string $title         Attachment title.
 * @return int Attachment ID, or 0 on failure.
 */
function bc_cd_import_asset( $relative_path, $title ) {
	$source = get_theme_file_path( $relative_path );
	if ( ! file_exists( $source ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$upload = wp_upload_bits( basename( $source ), null, file_get_contents( $source ) );
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$filetype   = wp_check_filetype( $upload['file'] );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => sanitize_text_field( $title ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);

	$attachment_id = wp_insert_attachment( $attachment, $upload['file'] );
	if ( is_wp_error( $attachment_id ) || ! $attachment_id ) {
		return 0;
	}

	$metadata = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
	wp_update_attachment_metadata( $attachment_id, $metadata );

	return (int) $attachment_id;
}

/**
 * On activation, set the site logo and site icon from the bundled brand assets,
 * so the header is branded immediately. Existing settings are never overwritten.
 */
function bc_cd_setup_brand_assets() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	if ( ! get_theme_mod( 'custom_logo' ) ) {
		$logo_id = bc_cd_import_asset( 'assets/images/site-logo.png', 'BC Creative Digital logo' );
		if ( $logo_id ) {
			set_theme_mod( 'custom_logo', $logo_id );
			update_option( 'site_logo', $logo_id );
		}
	}

	if ( ! get_option( 'site_icon' ) ) {
		$icon_id = bc_cd_import_asset( 'assets/images/site-icon-512.png', 'BC Creative Digital site icon' );
		if ( $icon_id ) {
			update_option( 'site_icon', $icon_id );
		}
	}
}
add_action( 'after_switch_theme', 'bc_cd_setup_brand_assets' );
// Also self-heal on admin load: if the logo/icon aren't set yet, set them.
// The function guards on get_theme_mod/get_option, so this runs once then no-ops.
add_action( 'admin_init', 'bc_cd_setup_brand_assets' );

/**
 * Security headers (ported from the previous theme).
 *
 * The CSP is sent in Report-Only mode so nothing is blocked while it's tuned
 * against the current plugin set (Jetpack, Site Kit, HubSpot, Clarity,
 * CookieAdmin). Once the browser console shows no violations on the key pages,
 * rename the header to 'Content-Security-Policy' (drop '-Report-Only') to enforce it.
 */
function bc_cd_security_headers() {
	if ( is_admin() ) {
		return;
	}

	header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
	header( 'Cross-Origin-Opener-Policy: same-origin' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );

	$csp = "default-src 'self'; "
		. "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com https://www.clarity.ms https://*.hs-scripts.com https://*.hsforms.net https://*.hubspot.com https://*.wp.com https://stats.wp.com; "
		. "style-src 'self' 'unsafe-inline'; "
		. "font-src 'self' data:; "
		. "img-src 'self' data: https:; "
		. "connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com https://www.clarity.ms https://*.hubspot.com https://*.hsforms.com https://*.wp.com https://stats.wp.com; "
		. "frame-src 'self' https://*.hubspot.com https://www.youtube.com https://player.vimeo.com; "
		. "frame-ancestors 'self';";

	header( 'Content-Security-Policy-Report-Only: ' . $csp );
}
add_action( 'send_headers', 'bc_cd_security_headers' );

/**
 * CookieAdmin consent fallback (ported from the previous theme).
 *
 * The plugin's own consent.js intermittently 503s, leaving its functions
 * undefined. This self-contained script reads/writes the cookieadmin_consent
 * cookie, wires up Accept / Reject / Save, and hides the banner on return
 * visits â€” independent of the plugin's own JS.
 */
function bc_cd_cookieadmin_fallback() {
	if ( is_admin() ) {
		return;
	}
	?>
	<script>
	(function(){
		var COOKIE = 'cookieadmin_consent';
		var PATH   = '/';
		var DAYS   = (window.cookieadmin_policy && window.cookieadmin_policy.cookieadmin_days) || 365;
		var IS_SSL = location.protocol === 'https:';

		function setCookie(name, val, days){
			var d = new Date();
			d.setTime(d.getTime() + days*864e5);
			var s = encodeURIComponent(name) + '=' + JSON.stringify(val)
				+ '; expires=' + d.toUTCString() + '; path=' + PATH + '; SameSite=Lax';
			if(IS_SSL) s += '; Secure';
			document.cookie = s;
		}
		function getCookie(name){
			var m = document.cookie.match('(^|;)\\s*' + name + '=([^;]+)');
			if(!m) return null;
			try{ return JSON.parse(decodeURIComponent(m[2])); }catch(e){ return null; }
		}
		function hideUI(){
			var b = document.querySelector('.cookieadmin_law_container');
			var m = document.querySelector('.cookieadmin_cookie_modal');
			var o = document.querySelector('.cookieadmin_modal_overlay');
			if(b) b.style.display = 'none';
			if(m) m.style.display = 'none';
			if(o) o.style.display = 'none';
		}
		function showReconsent(){
			var rc = document.querySelector('.cookieadmin_re_consent');
			if(rc) rc.style.display = 'block';
		}
		function saveAndHide(pref){
			setCookie(COOKIE, pref, DAYS);
			hideUI();
			showReconsent();
			if(typeof cookieadmin_pro_set_consent === 'function'){
				try{ cookieadmin_pro_set_consent(pref, DAYS); }catch(e){}
			}
		}
		if(typeof window.cookieadmin_set_cookie !== 'function'){ window.cookieadmin_set_cookie = setCookie; }
		if(typeof window.cookieadmin_is_consent === 'undefined'){ window.cookieadmin_is_consent = {}; }
		if(typeof window.cookieadmin_save_consent_cookie !== 'function'){
			window.cookieadmin_save_consent_cookie = function(pref, days){
				setCookie(COOKIE, pref, days || DAYS);
				window.cookieadmin_is_consent.action = pref;
			};
		}
		if(typeof window.cookieadmin_set_consent !== 'function'){
			window.cookieadmin_set_consent = function(pref){ saveAndHide(pref); };
		}
		var existing = getCookie(COOKIE);
		if(existing){ window.cookieadmin_is_consent.action = existing; }
		function showBanner(){
			var b = document.querySelector('.cookieadmin_law_container');
			if(b){
				b.style.display = 'block'; b.style.position = 'fixed';
				b.style.bottom = '0'; b.style.left = '0'; b.style.right = '0';
				b.style.width = '100%'; b.style.zIndex = '999999';
			}
		}
		document.addEventListener('DOMContentLoaded', function(){
			if(existing){ hideUI(); showReconsent(); return; }
			showBanner();
			document.querySelectorAll('.cookieadmin_accept_btn').forEach(function(btn){
				btn.addEventListener('click', function(){ saveAndHide({accept:'true'}); });
			});
			document.querySelectorAll('.cookieadmin_reject_btn').forEach(function(btn){
				btn.addEventListener('click', function(){ saveAndHide({reject:'true'}); });
			});
			var saveBtn = document.querySelector('.cookieadmin_save_btn');
			if(saveBtn){
				saveBtn.addEventListener('click', function(){
					var pref = {};
					document.querySelectorAll('.cookieadmin_toggle').forEach(function(t){
						if(t.children[0] && t.children[0].checked){
							var key = t.children[0].id.replace('cookieadmin-','');
							pref[key] = 'true';
						}
					});
					if(Object.keys(pref).length === 0){ pref = {reject:'true'}; }
					saveAndHide(pref);
				});
			}
		});
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'bc_cd_cookieadmin_fallback', 999 );
