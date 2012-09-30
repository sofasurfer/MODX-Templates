
/* 
* Load dynamic CSS files 
* If not already exists
*/
if( jQuery && !jQuery.getCSS ){
	jQuery.getCSS = function( url, media ) {
		if( $("link[href$='"+url+"']").length > 0 ){
			return true;
		}else{
			jQuery( document.createElement('link') ).attr({
				href: url,
				media: media || 'screen',
				type: 'text/css',
				rel: 'stylesheet'
			}).appendTo('head');
		}
	};
}



// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

!function ($) {

  $(function(){


    // tooltip demo
    $("a[rel=tooltip]").tooltip();
    $("a[rel=popover]").popover();
    
    
    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })
	
    // fix sub nav on scroll
    var $win = $(window)
      , $nav = $('.subnav')
      , navTop = $('.subnav').length && $('.subnav').offset().top - 40
      , isFixed = 0
	processScroll()
    $win.on('scroll', processScroll)
    function processScroll() {
	var i, scrollTop = $win.scrollTop()
	if (scrollTop >= navTop && !isFixed) {
		isFixed = 1
		$nav.addClass('subnav-fixed')
	} else if (scrollTop <= navTop && isFixed) {
		isFixed = 0
		$nav.removeClass('subnav-fixed')
	}

	return false;
    }
    $('.subnav a').click(function () {
	$('body,html').animate({
		scrollTop:  $( $(this).attr('href') ).offset().top - 100
	}, 800, 'easeOutExpo');
	return false;
    });     

    // Back to top
    $('#back-top').hide();
    $(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 280) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});
	$('#back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800, 'easeOutExpo');
		return false;
	});
    });
    

    // Support for AJAX loaded modal window.
    // Focuses on first input textbox after it loads the window.
    $('a[data-toggle="modal"]').click(function(e) {
	e.preventDefault();

	var href = $(this).attr('href');
	var target = $(this).attr('data-target');

	if ( href.indexOf('#') == 0) {
		$(target).modal('show');							
	} else {
	    $.get(href, function(data) {
		    $(target).empty();
		    $(target).html(data);
		    $(target).on('show', function(e) {	
			    var modal = $(this);
			    //modal.css('margin-top', (modal.outerHeight() / 2) * -1)
			    //modal.css('margin-left', (modal.outerWidth() / 2) * -1);
			    return this;							
		    });
		    $(target).on('hide', function () {
			    $(this).empty();
		    });				
	    }).success(function() { 
		if( $('video').length > 0 ){
		    $.getCSS('/assets/templates/mediaelement/build/mediaelementplayer.min.css');
		    $.getScript("/assets/templates/mediaelement/build/mediaelement-and-player.min.js", function(){
			$(target).modal('show');
			$('video').mediaelementplayer({
				enableAutosize: true,
				success: function(player, node) {
					$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
				}
			});
		    });
		}		
	    });
	}	
	return false;
    });
	
    //$.getScript("http://api.html5media.info/1.1.5/html5media.min.js");
    if( $('video,audio').length > 0 ){
	    $.getCSS('/assets/templates/mediaelement/build/mediaelementplayer.min.css');
	    $.getScript("/assets/templates/mediaelement/build/mediaelement-and-player.min.js", function(){
		    setTimeout(function(){
			    $('video,audio').mediaelementplayer({
				    success: function(player, node) {
					    $('#' + node.id + '-mode').html('mode: ' + player.pluginType);
				    }
			    });
		    }, 100);
	    });
    }	
  })

}(window.jQuery);

