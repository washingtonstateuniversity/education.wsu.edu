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
	);
}