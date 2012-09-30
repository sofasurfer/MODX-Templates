/* 
=======================================
	Evolve Concepts Ltd. Hong Kong
	http://www.evolve.hk
=======================================
*/
// Superfish code
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode}catch(e){p=this}}if(p==this){return false}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.mouseover(handleHover).mouseout(handleHover)}})(jQuery);(function($){$.fn.superfish=function(op){var sf=$.fn.superfish,c=sf.c,$arrow=$(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),over=function(){var $$=$(this),menu=getMenu($$);clearTimeout(menu.sfTimer);$$.showSuperfishUl().siblings().hideSuperfishUl()},out=function(){var $$=$(this),menu=getMenu($$),o=sf.op;clearTimeout(menu.sfTimer);menu.sfTimer=setTimeout(function(){o.retainPath=($.inArray($$[0],o.$path)>-1);$$.hideSuperfishUl();if(o.$path.length&&$$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path)}},o.delay)},getMenu=function($menu){var menu=$menu.parents(['ul.',c.menuClass,':first'].join(''))[0];sf.op=sf.o[menu.serial];return menu},addArrow=function($a){$a.addClass(c.anchorClass).append($arrow.clone())};return this.each(function(){var s=this.serial=sf.o.length;var o=$.extend({},sf.defaults,op);o.$path=$('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){$(this).addClass([o.hoverClass,c.bcClass].join(' ')).filter('li:has(ul)').removeClass(o.pathClass)});sf.o[s]=sf.op=o;$('li:has(ul)',this)[($.fn.hoverIntent&&!o.disableHI)?'hoverIntent':'hover'](over,out).each(function(){if(o.autoArrows)addArrow($('>a:first-child',this))}).not('.'+c.bcClass).hideSuperfishUl();var $a=$('a',this);$a.each(function(i){var $li=$a.eq(i).parents('li');$a.eq(i).focus(function(){over.call($li)}).blur(function(){out.call($li)})});o.onInit.call(this)}).each(function(){var menuClasses=[c.menuClass];if(sf.op.dropShadows&&!($.browser.msie&&$.browser.version<7))menuClasses.push(c.shadowClass);$(this).addClass(menuClasses.join(' '))})};var sf=$.fn.superfish;sf.o=[];sf.op={};sf.IE7fix=function(){var o=sf.op;if($.browser.msie&&$.browser.version>6&&o.dropShadows&&o.animation.opacity!=undefined)this.toggleClass(sf.c.shadowClass+'-off')};sf.c={bcClass:'sf-breadcrumb',menuClass:'sf-js-enabled',anchorClass:'sf-with-ul',arrowClass:'sf-sub-indicator',shadowClass:'sf-shadow'};sf.defaults={hoverClass:'sfHover',pathClass:'overideThisToUse',pathLevels:1,delay:800,animation:{opacity:'show'},speed:'normal',autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};$.fn.extend({hideSuperfishUl:function(){var o=sf.op,not=(o.retainPath===true)?o.$path:'';o.retainPath=false;var $ul=$(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass).find('>ul').hide().css('visibility','hidden');o.onHide.call($ul);return this},showSuperfishUl:function(){var o=sf.op,sh=sf.c.shadowClass+'-off',$ul=this.addClass(o.hoverClass).find('>ul:hidden').css('visibility','visible');sf.IE7fix.call($ul);o.onBeforeShow.call($ul);$ul.animate(o.animation,o.speed,function(){sf.IE7fix.call($ul);o.onShow.call($ul)});return this}})})(jQuery);

/* 
* Load dynamic CSS files 
* If not already exists
*/
if( jQuery && !jQuery.getCSS ){
	jQuery.getCSS = function( url, media ) {
	    jQuery( document.createElement('link') ).attr({
	        href: url,
	        media: media || 'screen',
	        type: 'text/css',
	        rel: 'stylesheet'
	    }).appendTo('head');
	};
}


// Functions
$(document).ready(function () {

	// Suckerfish menu
	$('ul.sf-menu').superfish({
		delay: 380,
		animation: {height: 'show'},
		disableHI: false,
		speed: 'fast',
		autoArrows: true,
		dropShadows: true		
	});
	
	jQuery("ul.sf-menu li:last").addClass("sf-menu-last");
	
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
	
	
	// hovers
	$("#portal-blocks li").hover(function() {
		$(this).css({'z-index' : '10'}); 
		$(this).find('img').addClass("hover").stop() 
			.animate({marginTop: '-15px', marginLeft: '0px', width: '229px', height: '136px'}, 200); 

		} , function() {
		$(this).css({'z-index' : '0'});
		$(this).find('img').removeClass("hover").stop() 
			.animate({marginTop: '0', marginLeft: '0', width: '229px', height: '136px'}, 200);
	});
	

	// Collapse
        $('#profileform').hide();
    
	$('#wrap-columnright .headerprofile').click(function(){
		$(this).toggleClass("active");
		$('#profileform').slideToggle(380);
	});
	
	$(".ourHolder li:nth-child(4n+4)").css("margin-top", "0!important");
	$("#menu-partydetails li:last").addClass("menu-partydetails-last");
	$('input:text:not(".textEditor")').each(function () {
        var txtval = $(this).val();
        $(this).focus(function () {
            $(this).val('')
        });
        $(this).blur(function () {
            if ($(this).val() == "") {
                $(this).val(txtval);
            }
        });
    });
    
	/*
	 * Set Birthdate Calendar
	*/
	if(  $('#dob').length > 0 ){
	  $.getCSS("https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css");
	    $.getScript("https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js", function(){
		setTimeout(function(){
		    $( "#dob" ).css({"width":"70px","margin-right":"10px"}).datepicker( { 
			dateFormat: "mm.dd.yy",
			changeYear: true,
			changeMonth: true,
			yearRange: '1900:' + new Date().getFullYear(),
			showOn: "button",
			buttonText: "Select birthday",
			buttonImage: "/assets/templates/default/media/calendar_icon.gif"
		    } );
		}, 100);
	    });
	}   

	/* 
	 * Load Fancybox for preview pop up
	* with dependecies
	*/				
	if(  $('.dynamicContent').length > 0 ){
		$(".dynamicContent").fancybox({
			helpers : {
				title : {
					type : 'inside'
				}
			}
		});
	} 	
});


// Target pods/tabs
jQuery(document).ready(function($){
	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID1 = deviceAgent.match(/(iphone|ipod|ipad)/);
	var agentID2 = deviceAgent.match(/(safari)/);
	if (agentID1) {
		$('#back-top a').css("display","none");
	}
	if (agentID2) {
		$('.sf-menu').css("width","630px");
	}
});	

