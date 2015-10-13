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

$(document).ready(function() {

  /*
    Pritty Code 
  */
  $('.prettyprint').html(function(i,h){
    return h.replace(/[<>\"\'\t\n]/g, function(m) { return {
      '<' : '&lt;',
      '>' : '&gt;',
      "'" : '&#39;',
      '"' : '&quot;',
      '\t': '  ',
      '\n': '<br/>' // needed for IE
    }[m]});
  });


  /*
    PIWIK custom tracking
  */
  $('.trackgoal').each( function( key, value ) {
      console.log('track-goal: ' + $(this).attr('data-goal'));
      _paq.push(['trackGoal', $(this).attr('data-goal')]);
  });


  /*
    Scroll Top
  */
  $('#back-top').hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 280) {
      $('#back-top').fadeIn();
    } else {
      $('#back-top').fadeOut();
    }
  });
  $("#back-top").click(function(event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
});
