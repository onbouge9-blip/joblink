<?php   
/**
 * Block Patterns
 *
 * @package Soul Anchor
 * @since 1.0
 */

/**
 * Registers block patterns and categories.
 *
 * @since 1.0
 *
 * @return void
 */
function soul_anchor_register_block_patterns() {
	$block_pattern_categories = array(
		'soul-anchor' => array( 'label' => esc_html__( 'Soul Anchor Patterns', 'soul-anchor' ) ),
		'pages'    => array( 'label' => esc_html__( 'Pages', 'soul-anchor' ) ),
	);

	$block_pattern_categories = apply_filters( 'soul_anchor_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'archive-inner-banner',
		'header-default',
		'header-banner',
		'inner-banner',
		'post-one-column',
		'post-two-column',
		'latest-blog',
		'hidden-404',
		'sidebar',
		'footer-default',	
	);

	$block_patterns = apply_filters( 'soul_anchor_block_patterns', $block_patterns );

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_parent_theme_file_path( '/inc/patterns/' . $block_pattern . '.php' );

		register_block_pattern(
			'soul-anchor/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', 'soul_anchor_register_block_patterns', 9 );