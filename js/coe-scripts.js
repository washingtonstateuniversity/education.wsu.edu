// custom scripts for WSU College of Education

// add bkgrd img functionality, iframe/YouTube responsiveness
(function( $ ){
	process_section_backgrounds = function() {
		var $bg_sections = $('.section-wrapper-has-background');
	
		$bg_sections.each( function() {
			var background_image = $(this).data('background');
			$(this).css('background-image', 'url(' + background_image + ')' );
        });
	};
	
	$(document).ready( function() {
		process_section_backgrounds();
	jQuery('iframe').wrap("<div class='iframe-wrap'></div>");
    
    });
    
    
    // adding fittext functionality
   		$(".row.single .column h2, .row.single .column h3, .row.single .column h4, .row .halves .column h2, .row.halves .column h3, .row.halves .column h4, .row.thirds .column h2, .row.thirds .column h3, .row.thirds .column h4, .row.quarters .column h2, .row.quarters .column h3, .row.quarters .column h4").fitText(1.1, { minFontSize: '21px', maxFontSize: '45px' });
		$(".fittext2").fitText(1.2);
		$(".fittext3").fitText(1.1, { minFontSize: '50px', maxFontSize: '75px' });
    
    // finding all hyperlinks with images to replace bkgrd color
    $('a').has('img').css('background-color','#fff');

    
    
$.fn.exists = function(callback) {
  var args = [].slice.call(arguments, 1);

  if (this.length) {
    callback.call(this, args);
  }

  return this;
};

// Usage
$('body.has-featured-image #header-bkgrd').hide();
    

// hide header-bkgrd when necessary
if($(".photo-story, .featured-story").length)
$("#header-bkgrd").hide();    

    
// colorbox
			$(document).ready(function(){
            
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
                $(".inline").colorbox({inline:true, width:"50%"});
                $(".size-lt-small .inline").colorbox({inline:true, width:"96%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			}); // end of colorbox    

    
    
// additional js implementation for rwdImageMaps
$(document).ready(function(e) {
    $('img[usemap]').rwdImageMaps();
});
    
}(jQuery, window));



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
;(function(a){a.fn.rwdImageMaps=function(){var c=this;var b=function(){c.each(function(){if(typeof(a(this).attr("usemap"))=="undefined"){return}var e=this,d=a(e);a("<img />").load(function(){var g="width",m="height",n=d.attr(g),j=d.attr(m);if(!n||!j){var o=new Image();o.src=d.attr("src");if(!n){n=o.width}if(!j){j=o.height}}var f=d.width()/100,k=d.height()/100,i=d.attr("usemap").replace("#",""),l="coords";a('map[name="'+i+'"]').find("area").each(function(){var r=a(this);if(!r.data(l)){r.data(l,r.attr(l))}var q=r.data(l).split(","),p=new Array(q.length);for(var h=0;h<p.length;++h){if(h%2===0){p[h]=parseInt(((q[h]/n)*100)*f)}else{p[h]=parseInt(((q[h]/j)*100)*k)}}r.attr(l,p.toString())})}).attr("src",d.attr("src"))})};a(window).resize(b).trigger("resize");return this}})(jQuery);