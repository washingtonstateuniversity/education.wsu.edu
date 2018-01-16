<?php

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
	wp_enqueue_script( 'fittext_script', get_stylesheet_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), spine_get_script_version(), true );
	wp_enqueue_script( 'coe_scripts', get_stylesheet_directory_uri() . '/js/coe-scripts.js', array( 'jquery' ), spine_get_script_version(), true );
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

	// Get the display title(s).
	if ( ! empty( $person->working_titles ) ) {
		if ( ! empty( $person->display_title ) ) {
			$display_titles = explode( ',', $person->display_title );
			foreach ( $display_titles as $display_title ) {
				if ( isset( $person->working_titles[ $display_title ] ) ) {
					$titles[] = $person->working_titles[ $display_title ];
				}
			}
		} else {
			$titles = $person->working_titles;
		}
	} else {
		$titles = array( $person->position_title );
	}

	ob_start();
	?>
	<div class="wsuwp-person-container"<?php if ( $photo ) { ?> style="background-image: url(<?php echo esc_url( $photo ); ?>);"<?php } ?>>
		<div class="wsuwp-person-info">
			<div class="wsuwp-person-name"><?php echo esc_html( $person->title->rendered ); ?></div>
			<?php foreach ( $titles as $title ) { ?>
			<div class="wsuwp-person-position"><?php echo esc_html( $title ); ?></div>
			<?php } ?>
		</div>
	</div>

	<?php
	$html = ob_get_clean();

	return $html;
}
