<?php
/**
 * BC Creative Digital — theme functions.
 *
 * @package BC_Creative_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BC_CD_VERSION', '1.0.2' );

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
