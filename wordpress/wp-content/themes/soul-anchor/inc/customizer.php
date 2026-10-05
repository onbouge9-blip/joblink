<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage Soul Anchor
 * @since Soul Anchor 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function soul_anchor_customize_register( $wp_customize ) {
    // Check for existence of WP_Customize_Manager before proceeding
	if ( ! class_exists( 'WP_Customize_Manager' ) ) {
        return;
    }
    
	$wp_customize->add_section( new Soul_Anchor_Customizer_Pro_Button( $wp_customize, 'upsell_premium_section', array(
		'title'       => __( 'Soul Anchor Pro', 'soul-anchor' ),
		'button_text' => __( 'Buy Pro Theme', 'soul-anchor' ),
		'url'         => esc_url( SOUL_ANCHOR_BUY_NOW ),
		'priority'    => 0,
	)));

	$wp_customize->add_section( new Soul_Anchor_Customizer_Pro_Button( $wp_customize, 'upsell_bundle_section', array(
		'title'       => __( 'Get All Themes', 'soul-anchor' ),
		'button_text' => __( 'Buy Now', 'soul-anchor' ),
		'url'         => esc_url( SOUL_ANCHOR_BUNDLE_LINK ),
		'priority'    => 0,
	)));

}
add_action( 'customize_register', 'soul_anchor_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) ) {
	class Soul_Anchor_Customizer_Pro_Button extends WP_Customize_Section {
		public $type = 'soul-anchor-buynow';
		public $button_text = '';
		public $url = '';

		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="soul_anchor_customizer_pro_button accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title premium-details">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}

/**
 * Enqueue script for custom customize control.
 */
function soul_anchor_custom_control_scripts() {
	wp_enqueue_script( 'soul-anchor-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );

    wp_enqueue_style( 'soul-anchor-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'soul_anchor_custom_control_scripts' );
