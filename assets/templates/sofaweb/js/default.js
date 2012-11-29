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

window.prettyPrint && prettyPrint();

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

// tooltip demo
$("a[rel=tooltip]").tooltip();
$("a[rel=tooltip-bottom]").tooltip({
	placement: 'bottom'
});

$("a[rel=popover]").popover();
$("a[rel=gallery]").popover({
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

/*
$("a.popover-right").popover({
	'html': true,
	'placement': 'right',
	'trigger': 'hover'
});
$("a.popover-left").popover({
	'html': true,
	'placement': 'left',
	'trigger': 'hover'
});
*/

$('#modTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})

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

if( $('a[rel="gallery"]').length > 0 ){
	$.getScript("http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js", function() {
		$.getScript("https://raw.github.com/blueimp/Bootstrap-Image-Gallery/master/js/bootstrap-image-gallery.min.js", function() {
			//alert('done');
		});
	});
}

// Support for AJAX loaded modal window.
// Focuses on first input textbox after it loads the window.
$('a[data-toggle="modal"]').click(function(e) {
    e.preventDefault();

    var href = $(this).attr('href');
    var rel = $(this).attr('rel');
    var title = $(this).attr('data-original-title');
    var target = $(this).attr('data-target');

    if ( rel.indexOf('#') >= 0 ) {
        $(target + '-inner .item.active').removeClass('active');							
        $(rel).addClass('active');									
        $(target).modal('show');							
    } else {
    	if( $(target).length == 0 ){
    		$("<div/>").attr('id',target.replace('#','')).attr('tabindex','-1').addClass('modal modal-gallery fade').appendTo('body');
    	}    	
        $.get(href, function(data) {
	        $(target).empty();
	        
	        var videoHtml = data.replace(/src="/g,'src="' + rel + '/');
	        videoHtml = videoHtml.replace('poster="','poster="' + rel + '/');

	        var dataHtml = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h3> '+title+'</h3></div><div id="modal-body" class="modal-body"><div class="modal-video">' + videoHtml + '</div></div></div>';
	        $(target).html(dataHtml);
	        $(target).on('hide', function () {
	            $(this).empty();
	        });
	        $(target).on('show', function () {
	        	var player = $(this).find('video')[0];
				$(this).find('.modal-body').css({
                	width: player.width,
                	height: player.height
       		    });
       		    $(this).find('.modal-footer').html( player.width + '/' + player.height );	        	
			});
        }).success(function() {			
			$('audio2,video2').mediaelementplayer({
				success: function(player, node) {
					//$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
	       		}
			});
			$(target).modal('show');
        });
    }	
    return false;
})
