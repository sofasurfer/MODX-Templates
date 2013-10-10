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
	}
}

/* Fix for iPAd */
$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });

window.prettyPrint && prettyPrint();

// tooltip demo
$('a[rel=tooltip]').tooltip();
$("a[rel=gallery]").tooltip();
$('a[rel=tooltip-bottom],a[data-toggle="modal"]').tooltip({
	placement: 'bottom'
});

$("a[rel=popover]").popover({
	html: true,
	'trigger': 'click'
});
$("a[rel=modal-video]").popover({
	html: true,
	placement: function (tip, element) {
        var offset = $(element).offset();
        height = $(document).outerHeight();
        width = $(document).outerWidth();
        vert = 0.5 * height - offset.top;
        vertPlacement = vert > 0 ? 'bottom' : 'top';
        horiz = 0.5 * width - offset.left;
        horizPlacement = horiz > 0 ? 'right' : 'left';
        placement = horizPlacement;
        //placement = Math.abs(horiz) > Math.abs(vert) ?  horizPlacement : vertPlacement;
        return placement;
	},
	'trigger': 'hover'
});


$('#modTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});

// Thumbnail hoover
$('.hover-group').mouseover(function(){
 $(this).addClass('visible');});
$('.hover-group').mouseout(function(){
  $(this).removeClass('visible');});

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
});
$('#back-top a').click(function () {
	$('body,html').animate({
		scrollTop: 0
	}, 800, 'easeOutExpo');
	return false;
});

if( $('#gMap').length > 0 ){
	$.getScript("/assets/templates/gmap/gmap.js", function() {
		setTimeout(function(){
			loadMapScript();
		},500);
	});
}

/* 
 * Include Gallery when exist 
 */
if( $('a[rel="gallery"]').length > 0 ){
	$.getScript("http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js", function() {
		$.getScript("https://raw.github.com/blueimp/Bootstrap-Image-Gallery/master/js/bootstrap-image-gallery.min.js", function() {
			//alert('done');
		});
	});
}

/* 
 * Include Media Elements when exist 
 */
if( 1==2 &&  $('audio,video').length > 0 ){
    $.getCSS("[[++site_url]]assets/templates/mediaelement/build/mediaelementplayer.min.css", function() {
		$.getScript("/assets/templates/mediaelement/build/mediaelement-and-player.min.js", function() {
			$('audio,video').mediaelementplayer({
				success: function(player, node) {
					$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
		   		}
			});
		});
	});
}

$('#site-search').typeahead({
    source: function (query, process) {
        return $.get('/system/search.js', { query: query }, function (data) {    	
            return process(data.options);
        });
    }
	,updater: function (obj) {
		var link = $(obj);
		document.location = link.attr('href');
    }    
});

// Support for AJAX loaded modal window.
// Focuses on first input textbox after it loads the window.
//$('a[rel="modal-video"]').tooltip();
$('a[rel="modal-video"]').click(function(e) {
    e.preventDefault();

    var href = $(this).attr('href');
    var title = $(this).attr('data-original-title');
    var rel = $(this).attr('data-target');
    var target = $('#modal-gallery');
    

	if( $(target).length == 0 ){
		$("<div/>").attr('id',target.replace('#','')).attr('tabindex','-1').addClass('modal modal-gallery fade').appendTo('body');
	}    	
    $.get(href, function(data) {

        //$(target).removeClass('.full-fullscreen');
        
        var videoHtml = data.replace(/src="/g,'src="' + rel + '/');
        videoHtml = videoHtml.replace('poster="','poster="' + rel + '/');
		videoHtml = '<div class="modal-video">' + videoHtml + '</div>';

        $(target).find('.modal-title').html(title);
        $(target).find('.modal-body').html(videoHtml);


        $(target).on('hide', function () {
            $(this).find('.modal-body').empty();
        });
        $(target).on('show', function () {
        	var player = $(this).find('video');
        	var playerWidth =  player.attr('width');
        	var playerHeight = player.attr('height');
			/*
			$(this).find('.modal-body').css({
            	'width': playerWidth,
            	'height': playerHeight
   		    });
			*/
			$(this).css({
            	'margin-left': -(playerWidth/2),
            	'margin-top': -(playerHeight/2)
   		    });       		    
   		    $(this).find('.modal-download').attr('href', href.replace('html','mp4') );	        	
   		    $(this).find('.modal-download').hide();	        	
   		    $(this).find('.modal-prev').hide();	        	
   		    $(this).find('.modal-next').hide();	        	
   		    $(this).find('.modal-play').hide();	        	

		});
    }).success(function() {			
		$(target).modal('show');
    });

    return false;
});