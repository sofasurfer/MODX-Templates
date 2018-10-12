
function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}


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
    Page load
  */
  var loadTime = (Date.now()-timerStart);
  $('#debuginfo').html('Page loaded ' + loadTime + ' ms (cache)');



  /*

    Cookie Banner

  */
  if ( !getCookie('cookiebanner') ) {
    $('#cookiebanner').show();
    $('#closecookiebanner').click(function(event){
      event.preventDefault();
      setCookie('cookiebanner','TRUE');
      $('#cookiebanner').hide();
    });
  }

  /*
    Pritty Code 
  */
  $( 'pre' ).each( function(key, value){
    $(this).text( $(this).html() );
  });

  $('.prettyprint_old').html(function(i,h){
    return h.replace(/[<>\"\'\t\n]/g, function(m) { return {
      '<' : '&lt;',
      '>' : '&gt;',
      "'" : '&#39;',
      '"' : '&quot;',
      '\t': '  ',
      '\n': '<br/>'
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
      $('body').addClass('sticky');
    } else {
      $('#back-top').fadeOut();
      $('body').removeClass('sticky');
    }
  });
  $("#back-top").click(function(event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });


  /*
    Image gallery stuff
  */
  document.getElementById('blueimp-gallery-images').onclick = function (event) {     
      event = event || window.event;
      var target = event.target || event.srcElement,
          link = target.src ? target.parentNode : target,
          options = {index: link, event: event},
          links = this.getElementsByTagName('a');    
      blueimp.Gallery(links, options);
  };

  /*
    GitHub Widget
  */
  if( $('.github-widget').length > 0 ){
    $.getScript( "/assets/templates/sofaweb/js/jquery.githubRepoWidget.min.js", function( data, textStatus, jqxhr ) {
      console.log('load githubRepoWidget');
    });
  };
});

$(window).load(function(){

  /*
    Masonry grid
  */
  $('.grid').masonry({
    // options
    itemSelector: '.grid-item',
  });

});


