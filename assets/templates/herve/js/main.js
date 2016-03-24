
$( document ).ready(function() {
    console.log( "document loaded" );

    return true;
    
    // Add Debug div
    $('<div/>', {
	    id: 'debug',
	    text: 'debug'
	}).appendTo('body');


    var currentMousePos = { x: -1, y: -1 };
    $('body').mousemove(function(event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
	    $('#debug').text('x:' + currentMousePos.x + ' y:' + currentMousePos.y);	
	    var xpos = Math.round(currentMousePos.x/10);
	    var ypos = Math.round(currentMousePos.y/5);

	    $('h1').css('margin-left', xpos);
	    $('h1').css('margin-top', ypos);
    });

});





/*

herve_thiot

userId: 2030649774,


var url = "/stream/assets/instafeed/instafeed.min.js";
$.getScript( url, function() {
    var feed = new Instafeed({
        get: 'user',
        userId: 2030649774,
        template: '<a href="{{link}}"><img src="{{image}}" /></a>'
    });
    feed.run();
});

*/
