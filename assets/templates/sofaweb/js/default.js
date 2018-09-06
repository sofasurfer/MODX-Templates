
/*
 * Bootstrap Image Gallery 3.0.1
 * https://github.com/blueimp/Bootstrap-Image-Gallery
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*global define, window */

(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define([
            'jquery',
            './blueimp-gallery'
        ], factory);
    } else {
        factory(
            window.jQuery,
            window.blueimp.Gallery
        );
    }
}(function ($, Gallery) {
    'use strict';

    $.extend(Gallery.prototype.options, {
        useBootstrapModal: true
    });

    var close = Gallery.prototype.close,
        imageFactory = Gallery.prototype.imageFactory,
        videoFactory = Gallery.prototype.videoFactory,
        textFactory = Gallery.prototype.textFactory;

    $.extend(Gallery.prototype, {

        modalFactory: function (obj, callback, factoryInterface, factory) {
            if (!this.options.useBootstrapModal || factoryInterface) {
                return factory.call(this, obj, callback, factoryInterface);
            }
            var that = this,
                modalTemplate = this.container.children('.modal'),
                modal = modalTemplate.clone().show()
                    .on('click', function (event) {
                        // Close modal if click is outside of modal-content:
                        if (event.target === modal[0] ||
                                event.target === modal.children()[0]) {
                            event.preventDefault();
                            event.stopPropagation();
                            that.close();
                        }
                    }),
                element = factory.call(this, obj, function (event) {
                    callback({
                        type: event.type,
                        target: modal[0]
                    });
                    modal.addClass('in');
                }, factoryInterface);
            modal.find('.modal-title').text(element.title || String.fromCharCode(160));
            modal.find('.modal-body').append(element);
            return modal[0];
        },

        imageFactory: function (obj, callback, factoryInterface) {
            return this.modalFactory(obj, callback, factoryInterface, imageFactory);
        },

        videoFactory: function (obj, callback, factoryInterface) {
            return this.modalFactory(obj, callback, factoryInterface, videoFactory);
        },

        textFactory: function (obj, callback, factoryInterface) {
            return this.modalFactory(obj, callback, factoryInterface, textFactory);
        },

        close: function () {
            this.container.find('.modal').removeClass('in');
            close.call(this);
        }

    });

}));



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
  var fullscreenOptions = {
      // Defines if the gallery should open in fullscreen mode:
      fullScreen: true
  };
  $( "#links" ).click(function(event) {
      event = event || window.event;
      var target = event.target || event.srcElement,
          link = target.src ? target.parentNode : target,
          options = {fullScreen: true, index: link, event: event},
          links = this.getElementsByTagName('a');
      blueimp.Gallery(links, options);
  });
  
  $( "#links btn" ).text('');

  $('.item-hover').hover( function() {
      $(this).find('.item-hover-caption').fadeIn(300);
  }, function() {
      $(this).find('.item-hover-caption').fadeOut(100);
  })


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


