<?php

add_filter( 'spine_child_theme_version', 'education_theme_version' );
/**
 * Provides a theme version for use in cache busting.
 *
 * @since 0.2.0
 *
 * @return string
 */
function education_theme_version() {
	return '0.2.2';
}

add_filter( 'wsu_color_palette_values', 'wsu_education_color_palette_values' );
/**
 * Alter the defaults provided by the WSU Color Palette plugin.
 *
 * @return array
 */
function wsu_education_color_palette_values() {
	return array(
		'default' => array(
			'name' => 'Blue',
			'hex' => '#3e8b94',
		),
		'yellow' => array(
			'name' => 'Yellow',
			'hex' => '#c69214',
		),
		'green' => array(
			'name' => 'Green',
			'hex' => '#ada400',
		),
	);
}


/**
 * Remove additional page templates from the drop-down menu when editing pages.
 */
function tfc_remove_page_templates( $templates ) {
	unset( $templates['templates/halves.php'] );
	unset( $templates['templates/margin-left.php'] );
	unset( $templates['templates/margin-right.php'] );
	unset( $templates['templates/side-left.php'] );
	unset( $templates['templates/side-right.php'] );
	unset( $templates['templates/single.php'] );
	return $templates;
}
add_filter( 'theme_page_templates', 'tfc_remove_page_templates' );


// Enqueue custom College of Education scripts
// Enqueue custom fittext script
add_action( 'wp_enqueue_scripts', 'fittext_script', 11 );

function fittext_script() {
	wp_enqueue_script( 'fittext_script', get_stylesheet_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), education_theme_version(), true );
	wp_enqueue_script( 'coe_scripts', get_stylesheet_directory_uri() . '/js/coe-scripts.js', array( 'jquery' ), education_theme_version(), true );
}

add_filter( 'wsuwp_people_item_html', 'education_people_html', 10, 2 );
/**
 * Provide a custom HTML template for use with syndicated people.
 *
 * @param string   $html   The HTML to output for an individual person.
 * @param stdClass $person Object representing a person received from people.wsu.edu.
 *
 * @return string The HTML to output for a person.
 */
function education_people_html( $html, $person ) {
	// Cast the photo collection as an array to account for
	// scenarios where it can sometimes come through as an object.
	$photo_collection = (array) $person->photos;
	$photo = false;

	// Get the URL of the photo.
	if ( ! empty( $photo_collection ) && isset( $photo_collection[0] ) ) {
		$photo = $photo_collection[0]->medium;
	}

	// Get the legacy profile photo URL if the person's collection is empty.
	if ( ! $photo && isset( $person->profile_photo ) ) {
		$photo = $person->profile_photo;
	}

	// Get the website meta.
	$link = ( ! empty( $person->website ) ) ? $person->website : false;

	$classes = 'wsuwp-person-container';

	if ( $link ) {
		$classes .= ' linked';
	}

	$program = false;

	// Get the profile tags.
	if ( ! empty( $person->taxonomy_terms->post_tag ) ) {
		foreach ( $person->taxonomy_terms->post_tag as $tag ) {
			$program = $tag->name;
		}
	}

	// Add classes based on taxonomy terms.
	if ( ! empty( $person->taxonomy_terms ) ) {
		foreach ( $person->taxonomy_terms as $taxonomy => $terms ) {
			$prefix = array_pop( explode( '_', $taxonomy ) );
			foreach ( $terms as $term ) {
				$classes .= ' ' . $prefix . '-' . $term->slug;
			}
		}
	}

	ob_start();
	?>
	<div class="<?php echo esc_attr( $classes ); ?>"<?php if ( $photo ) { ?> style="background-image: url(<?php echo esc_url( $photo ); ?>);"<?php } ?>>
		<?php if ( $link ) { ?><a href="<?php echo esc_url( $link ) ?>"><?php } ?>
		<div class="wsuwp-person-info">
			<?php if ( $link ) { ?>
			<div class="screen-reader-text">View profile for</div>
			<?php } ?>
			<div class="wsuwp-person-name"><?php echo esc_html( $person->title->rendered ); ?></div>
			<?php if ( $program ) { ?>
			<div class="wsuwp-person-program"><?php echo esc_html( $program ); ?></div>
			<?php } ?>
		</div>
		<?php if ( $link ) { ?></a><?php } ?>
	</div>

	<?php
	$html = ob_get_clean();

	return $html;
}
