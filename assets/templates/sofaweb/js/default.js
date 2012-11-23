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
$("a[rel=popover]").popover();

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
// Support for AJAX loaded modal window.
// Focuses on first input textbox after it loads the window.
$('a[data-toggle="modal"]').popover({
	trigger: 'hover'
	,placement: 'bottom'
});
$('a[data-toggle="modal"]').click(function(e) {
    e.preventDefault();

    var href = $(this).attr('href');
    var rel = $(this).attr('rel');
    var title = $(this).attr('data-original-title');
    var target = $(this).attr('data-target');

    if ( href.indexOf('#8') == 0) {
        $(target).modal('show');							
    } else {
    	if( $(target).length == 0 ){
    		$("<div/>").attr('id',target.replace('#','')).addClass('modal').appendTo('body');
    	}    	
        $.get(href, function(data) {
	        $(target).empty();
	        
	        var videoHtml = data.replace(/src="/g,'src="' + rel + '/');
	        videoHtml = videoHtml.replace('poster="','poster="' + rel + '/');

	        var dataHtml = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h3> '+title+'</h3></div><div id="modal-body" class="modal-body">' + videoHtml + '</div></div>';
	        $(target).html(dataHtml);
	        $(target).on('hide', function () {
	            $(this).empty();
	        });
	        $(target).on('show', function () {
			});
			$(target).modal('show');
        }).success(function() {
			$('audio,video').mediaelementplayer({
				success: function(player, node) {
					$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
					//player.play();
				}
			});
        });
    }	
    return false;
})
