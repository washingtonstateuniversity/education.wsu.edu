// Add bkgrd img functionality, iframe/YouTube responsiveness
( function( $, window ) {
	function process_section_backgrounds() {
		var $bg_sections = $( ".section-wrapper-has-background" );

		$bg_sections.each( function() {
			var background_image = $( this ).data( "background" );
			$( this ).css( "background-image", "url(" + background_image + ")" );
		} );
	}

	$( document ).ready( function() {
		process_section_backgrounds();
		$( "iframe" ).wrap( "<div class='iframe-wrap'></div>" );
	} );

	// Adding fittext functionality

	// jscs:disable maximumLineLength
	$( ".row.single .column h2, .row.single .column h3, .row.single .column h4, .row .halves .column h2, .row.halves .column h3, .row.halves .column h4, .row.thirds .column h2, .row.thirds .column h3, .row.thirds .column h4, .row.quarters .column h2, .row.quarters .column h3, .row.quarters .column h4" ).fitText( 1.1, { minFontSize: "21px", maxFontSize: "45px" } );

	// jscs:enable maximumLineLength

	$( ".fittext2" ).fitText( 1.2 );
	$( ".fittext3" ).fitText( 1.1, { minFontSize: "50px", maxFontSize: "75px" } );

	// Finding all hyperlinks with images to replace bkgrd color
	$( "a" ).has( "img" ).css( "background-color", "#fff" );

	$.fn.exists = function( callback ) {
		var args = [].slice.call( arguments, 1 );

		if ( this.length ) {
			callback.call( this, args );
		}

		return this;
	};

	// Usage
	$( "body.has-featured-image #header-bkgrd" ).hide();

	// Hide header-bkgrd when necessary
	if ( $( ".photo-story, .featured-story" ) .length ) {
		$( "#header-bkgrd" ).hide();
	}

	// Colorbox
	$( document ).ready( function() {

		// Examples of how to assign the Colorbox event to elements
		$( ".group1" ).colorbox( { rel: "group1" } );
		$( ".group2" ).colorbox( { rel: "group2", transition: "fade" } );
		$( ".group3" ).colorbox( { rel: "group3", transition: "none", width: "75%", height: "75%" } );
		$( ".group4" ).colorbox( { rel: "group4", slideshow: true } );
		$( ".ajax" ).colorbox();
		$( ".youtube" ).colorbox( { iframe: true, innerWidth: 640, innerHeight: 390 } );
		$( ".vimeo" ).colorbox( { iframe: true, innerWidth: 500, innerHeight: 409 } );
		$( ".iframe" ).colorbox( { iframe: true, width: "80%", height: "80%" } );
		$( ".inline" ).colorbox( { inline: true, width: "50%" } );
		$( ".size-lt-small .inline" ).colorbox( { inline: true, width: "96%" } );
		$( ".callbacks" ).colorbox( {
			onOpen: function() { window.alert( "onOpen: colorbox is about to open" ); },
			onLoad: function() { window.alert( "onLoad: colorbox has started to load the targeted content" ); },
			onComplete: function() { window.alert( "onComplete: colorbox has displayed the loaded content" ); },
			onCleanup: function() { window.alert( "onCleanup: colorbox has begun the close process" ); },
			onClosed: function() { window.alert( "onClosed: colorbox has completely closed" ); }
		} );

		$( ".non-retina" ).colorbox( { rel: "group5", transition: "none" } );
		$( ".retina" ).colorbox( { rel: "group5", transition: "none", retinaImage: true, retinaUrl: true } );

		// Example of preserving a JavaScript event for inline calls.
		$( "#click" ).click( function() {
			$( "#click" ).css( { "background-color": "#f00", "color": "#fff", "cursor": "inherit" } ).text( "Open this window again and this message will still be here." );
			return false;
		} );
	} ); // End of colorbox

	// Additional js implementation for rwdImageMaps
	$( document ).ready( function() {
		$( "img[usemap]" ).rwdImageMaps();
	} );

	/*
	 * rwdImageMaps jQuery plugin v1.5
	 *
	 * Allows image maps to be used in a responsive design by recalculating the area coordinates to match the actual image size on load and window.resize
	 *
	 * Copyright (c) 2013 Matt Stow
	 * https://github.com/stowball/jQuery-rwdImageMaps
	 * http://mattstow.com
	 * Licensed under the MIT license
	*/
	$.fn.rwdImageMaps = function() {
		var $img = this;

		var rwdImageMap = function() {
			$img.each( function() {
				if ( typeof( $( this ).attr( "usemap" ) ) === "undefined" ) {
					return;
				}

				var that = this,
					$that = $( that );

				// Since WebKit doesn't know the height until after the image has loaded, perform everything in an onload copy
				$( "<img />" ).on( "load", function() {
					var attrW = "width",
						attrH = "height",
						w = $that.attr( attrW ),
						h = $that.attr( attrH );

					if ( !w || !h ) {
						var temp = new Image();

						temp.src = $that.attr( "src" );

						if ( !w ) {
							w = temp.width;
						}

						if ( !h ) {
							h = temp.height;
						}
					}

					var wPercent = $that.width() / 100,
						hPercent = $that.height() / 100,
						map = $that.attr( "usemap" ).replace( "#", "" ),
						c = "coords";

					$( "map[name='" + map + "']" ).find( "area" ).each( function() {
						var $this = $( this );

						if ( !$this.data( c ) ) {
							$this.data( c, $this.attr( c ) );
						}

						var coords = $this.data( c ).split( "," ),
							coordsPercent = new Array( coords.length );

						for ( var i = 0; i < coordsPercent.length; ++i ) {
							if ( i % 2 === 0 ) {
								coordsPercent[ i ] = parseInt( ( ( coords[ i ] / w ) * 100 ) * wPercent );
							} else {
								coordsPercent[ i ] = parseInt( ( ( coords[ i ] / h ) * 100 ) * hPercent );
							}
						}
						$this.attr( c, coordsPercent.toString() );
					} );
				} ).attr( "src", $that.attr( "src" ) );
			} );
		};

		$( window ).resize( rwdImageMap ).trigger( "resize" );

		return this;
	};

}( jQuery, window ) );
