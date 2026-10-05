<?php
/**
 * Theme Info Page
 *
 * @package Soul Anchor
 */

function soul_anchor_theme_details() {
	add_theme_page( 'Themes', 'Soul Anchor Theme', 'edit_theme_options', 'soul-anchor-theme-info-page', 'theme_details_display', null );
}
add_action( 'admin_menu', 'soul_anchor_theme_details' );

function theme_details_display() {

	include_once 'templates/theme-details.php';

}

add_action( 'admin_enqueue_scripts', 'soul_anchor_theme_details_style' );

function soul_anchor_theme_details_style() {
    wp_register_style( 'soul_anchor_theme_details_css', get_template_directory_uri() . '/inc/soul-anchor-theme-info-page/css/theme-details.css', false, '1.0.0' );
    wp_enqueue_style( 'soul_anchor_theme_details_css' );

    wp_register_script( 'soul_anchor_copy_coupon_js', get_template_directory_uri() . '/inc/soul-anchor-theme-info-page/js/soul-anchor-copy-coupon.js', array(), '1.0.0', true );
    wp_enqueue_script( 'soul_anchor_copy_coupon_js' );
}