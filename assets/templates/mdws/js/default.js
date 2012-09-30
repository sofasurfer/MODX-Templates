/**
 * Colaps Fieldsets
 */
$.fn.collapse = function(options) {
	var defaults = {
		closed : false
	}
	settings = $.extend({}, defaults, options);

	return this.each(function() {
		var obj = $(this);		
		var legendText = obj.find("legend").text();			
		obj.find("legend").addClass('collapsible').click(function() {
			if (obj.hasClass('collapsed')){
				obj.removeClass('collapsed').addClass('collapsible');
			}else{
				$(this).removeClass('collapsed');
			}
			obj.children().not('legend').toggle("slow", function() {
			 
				 if ($(this).is(":visible")){
				 	obj.find("legend").text( 'close' );
					obj.find("legend").addClass('collapsible');
				 }else{
				  	obj.find("legend").text( legendText );
					obj.addClass('collapsed').find("legend").addClass('collapsed');
				}
			 });
		});
		if (settings.closed) {
			obj.addClass('collapsed').find("legend").addClass('collapsed');
			obj.children().not('legend').hide();
		}
	});
};


/**
 * Init Javascript 
 */

$(document).ready(function() {

		//$("fieldset.loginLoginFieldset").collapse( { closed: true } );

});
