

<?php
/**
 * Server-side rendering of the `core/term-description` block.
 *
 * @package WordPress
 */

/**
 * Renders the `core/term-description` block on the server.
 *
 * @param array $attributes Block attributes.
 *
 * @return string Returns the description of the current taxonomy term, if available
 */
function render_block_core_term_description( $attributes ) {
	$term_description = '';

	if ( is_category() || is_tag() || is_tax() ) {
		$term_description = term_description();
	}

	if ( empty( $term_description ) ) {
		return '';
	}

	$extra_attributes   = ( isset( $attributes['textAlign'] ) )
		? array( 'class' => 'has-text-align-' . $attributes['textAlign'] )
		: array();
	$wrapper_attributes = get_block_wrapper_attributes( $extra_attributes );

	return '<div ' . $wrapper_attributes . '>' . $term_description . '</div>';
}

/**
 * Registers the `core/term-description` block on the server.
 */
function register_block_core_term_description() {
	register_block_type_from_metadata(
		__DIR__ . '/term-description',
		array(
			'render_callback' => 'render_block_core_term_description',
		)
	);
}
add_action( 'init', 'register_block_core_term_description' );
