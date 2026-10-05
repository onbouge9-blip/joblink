<?php
/**
 * Soul Anchor functions and definitions
 *
 * @package Soul Anchor
 * @since 1.0
 */

if ( ! function_exists( 'soul_anchor_support' ) ) :
	function soul_anchor_support() {
			
		load_theme_textdomain( 'soul-anchor', get_template_directory() . '/languages' );

		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'soul_anchor_custom_background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
		
		add_theme_support( 'wp-block-styles' );

		add_editor_style( 'style.css' );

		define('SOUL_ANCHOR_BUY_NOW',__('https://www.themescarts.com/products/tour-wordpress-theme/','soul-anchor'));
		define('SOUL_ANCHOR_FOOTER_BUY_NOW',__('https://www.themescarts.com/products/free-travel-wordpress-theme/','soul-anchor'));
		define('SOUL_ANCHOR_BUNDLE_LINK',__('https://www.themescarts.com/products/wordpress-theme-bundle/','soul-anchor'));

	}
endif;
add_action( 'after_setup_theme', 'soul_anchor_support' );

/*-------------------------------------------------------------
 Enqueue Styles
--------------------------------------------------------------*/

if ( ! function_exists( 'soul_anchor_styles' ) ) :
	function soul_anchor_styles() {
		// Register theme stylesheet.
		wp_enqueue_style('soul-anchor-style', get_stylesheet_uri(), array(), wp_get_theme()->get('version') );
		wp_enqueue_style('soul-anchor-style-blocks', get_template_directory_uri(). '/assets/css/blocks.css');
		wp_enqueue_style('soul-anchor-style-responsive', get_template_directory_uri(). '/assets/css/responsive.css');
		wp_style_add_data( 'soul-anchor-basic-style', 'rtl', 'replace' );

		//animation
		wp_enqueue_script( 'wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );
		wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	}

endif;
add_action( 'wp_enqueue_scripts', 'soul_anchor_styles' );

function soul_anchor_enqueue_admin_script($hook) {
    // Enqueue admin JS for notices
    wp_enqueue_script('soul-anchor-welcome-notice', get_template_directory_uri() . '/inc/soul-anchor-theme-info-page/js/soul-anchor-welcome-notice.js', array('jquery'), '', true);
    
    // Localize script to pass data to JavaScript
    wp_localize_script('soul-anchor-welcome-notice', 'soul_anchor_localize', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('soul_anchor_welcome_nonce'),
        'dismiss_nonce' => wp_create_nonce('soul_anchor_welcome_nonce'), // Nonce for dismissal
        'redirect_url' => admin_url('themes.php?page=soul-anchor-theme-info-page'),
        'i18n' => array(
            'installing' => esc_html__( 'Installing and Activating recommended plugins…', 'soul-anchor' ),
            'retry'      => esc_html__( 'Installation failed. Click to retry', 'soul-anchor' ),
        ),
        'activated' => function_exists( 'Soul_Anchor\\soul_anchor_is_activation_completed' ) ? \Soul_Anchor\soul_anchor_is_activation_completed() : false,
    ));
}
add_action('admin_enqueue_scripts', 'soul_anchor_enqueue_admin_script');

if (!function_exists('soul_anchor_enable_plugin_autoupdate')) {

    add_filter('auto_update_plugin', function ($update, $item) {
        if ($item->slug === 'siteready-coming-soon-under-construction') {
            return true;
        }
        return $update;
    }, 10, 2);

}

function soul_anchor_plugin_update_available($slug, $file) {
    $updates = get_site_transient('update_plugins');

    if (!isset($updates->response[$slug . '/' . $file])) {
        return false; // No update available
    }

    return $updates->response[$slug . '/' . $file];
}

require get_template_directory() .'/inc/TGM/tgm.php';

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

require_once get_theme_file_path( 'inc/soul-anchor-theme-info-page/templates/class-theme-notice.php' );
require_once get_theme_file_path( 'inc/soul-anchor-theme-info-page/class-theme-info.php' );

require_once get_theme_file_path( '/inc/customizer.php' );

?>