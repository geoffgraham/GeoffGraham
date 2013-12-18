// CONTENTS
// -----------

// Responsive Menu
// Animate Bar Chart
// Lettering.js
// FitText.js

// Responsive Menu
$(document).ready(function() {
  $('body').addClass('js');
  var $menu = $('#menu'),
    $menulink = $('.menu-icon');
  
$menulink.click(function() {
  $menulink.toggleClass('active');
  $menu.toggleClass('active');
  return false;
});});

// Back to Top with smooth scroll
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });
});

// Animate Bar Chart
$(document).ready(function(){
  $(".chart .teal").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .teal").mouseleave(function(){
    $(this).animate({height:'95%'},800);
  });
  $(".chart .salmon").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .salmon").mouseleave(function(){
    $(this).animate({height:'90%'},800);
  });
  $(".chart .peach").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .peach").mouseleave(function(){
    $(this).animate({height:'80%'},800);
  });
  $(".chart .lime").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .lime").mouseleave(function(){
    $(this).animate({height:'75%'},800);
  });
  $(".chart .grape").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .grape").mouseleave(function(){
    $(this).animate({height:'40%'},800);
  });
});

// Lettering.JS 0.6.1
// Copyright 2010, Dave Rupert http://daverupert.com
// Released under the WTFPL license 
// Date: Mon Sep 20 17:14:00 2010 -0600

(function($){
	function injector(t, splitter, klass, after) {
		var a = t.text().split(splitter), inject = '';
		if (a.length) {
			$(a).each(function(i, item) {
				inject += '<span class="'+klass+(i+1)+'">'+item+'</span>'+after;
			});
			t.empty().append(inject);
		}
	}
	
	var methods = {
		init : function() {

			return this.each(function() {
				injector($(this), '', 'char', '');
			});

		},

		words : function() {

			return this.each(function() {
				injector($(this), ' ', 'word', ' ');
			});

		},
		
		lines : function() {

			return this.each(function() {
				var r = "eefec303079ad17405c889e092e105b0";
				// Because it's hard to split a <br/> tag consistently across browsers,
				// (*ahem* IE *ahem*), we replace all <br/> instances with an md5 hash 
				// (of the word "split").  If you're trying to use this plugin on that 
				// md5 hash string, it will fail because you're being ridiculous.
				injector($(this).children("br").replaceWith(r).end(), r, 'line', '');
			});

		}
	};

	$.fn.lettering = function( method ) {
		// Method calling logic
		if ( method && methods[method] ) {
			return methods[ method ].apply( this, [].slice.call( arguments, 1 ));
		} else if ( method === 'letters' || ! method ) {
			return methods.init.apply( this, [].slice.call( arguments, 0 ) ); // always pass an array
		}
		$.error( 'Method ' +  method + ' does not exist on jQuery.lettering' );
		return this;
	};

})(jQuery);

// FitText.js 1.1
// Copyright 2011, Dave Rupert http://daverupert.com
// Released under the WTFPL license
// Date: Thu May 05 14:23:00 2011 -0600

(function( $ ){

  $.fn.fitText = function( kompressor, options ) {

    // Setup options
    var compressor = kompressor || 1,
        settings = $.extend({
          'minFontSize' : Number.NEGATIVE_INFINITY,
          'maxFontSize' : Number.POSITIVE_INFINITY
        }, options);

    return this.each(function(){

      // Store the object
      var $this = $(this);

      // Resizer() resizes items based on the object width divided by the compressor * 10
      var resizer = function () {
        $this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
      };

      // Call once to set.
      resizer();

      // Call on resize. Opera debounces their resize by default.
      $(window).on('resize.fittext orientationchange.fittext', resizer);

    });

  };

})( jQuery );

// FitVids
$(document).ready(function(){
    $(".content").fitVids();
  });