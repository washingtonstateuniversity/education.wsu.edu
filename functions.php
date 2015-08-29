<?php

add_filter( 'wsu_color_palette_values', 'wsu_education_color_palette_values' );
/**
 * Alter the defaults provided by the WSU Color Palette plugin.
 *
 * @return array
 */
function wsu_education_color_palette_values() {
	return array(
		'default' => array( 'name' => 'Blue',  'hex' => '#3e8b94' ),
		'yellow' => array( 'name' => 'Yellow',  'hex' => '#c69214' ),
		'green' => array( 'name' => 'Green',  'hex' => '#ada400' ),
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