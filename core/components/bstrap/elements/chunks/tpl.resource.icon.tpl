<div class="[[+cls]] item-hover">
	    <a  class="[[+clsLink]]" title="[[+name]]" href="[[+tv.siteurl]]" target="_blank" >
	        [[+tv.pageimage:notempty=`<img class="[[+clsImage]]" src="[[+tv.pageimage:phpthumbof=`w=[[+thumbWidth:default=`360`]]&h=[[+thumbHeight:default=`180`]]&zc=[[+zoomCrop:default=`1`]]`]]" alt="[[+name]]" />`]]	        
		    <div class="caption item-hover-caption">
	        [[+title:notempty=`<h3>[[+tv.navicon:notempty=`<i class="[[+tv.navicon]]"></i> `]][[+title]]</h3>`]]
		    [[+description:isnot=``:then=`[[+description:strip_tags=``]]`:else=`[[+caption:strip_tags=``]]`]]
		    </div>  
	    </a>
</div>
[[+idx:add:lt=`[[+total]]`:and:mod=`[[+pageSlider]]`:isequal=`0`:then=`[[+pageSliderContent]]`]]