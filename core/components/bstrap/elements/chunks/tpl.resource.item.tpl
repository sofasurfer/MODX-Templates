<div class="[[+cls]]">
	    <a  class="[[+clsLink]]" title="[[+name]]" href="[[~[[+id]]]]" >
	        [[+tv.pageimage:notempty=`<img class="[[+clsImage]]" src="[[+tv.pageimage:phpthumbof=`w=[[+thumbWidth:default=`360`]]&h=[[+thumbHeight:default=`180`]]&zc=[[+zoomCrop:default=`1`]]`]]" alt="[[+name]]" />`]]	        
	        [[+title:notempty=`<h3>[[+tv.navicon:notempty=`<i class="[[+tv.navicon]]"></i> `]][[+title]]</h3>`]]
	    </a>
	    <div class="[[+caption-class:default=`caption`]]">
	    [[+description:isnot=``:then=`[[+description]]`:else=`[[+caption]]`]]	  
	    </div>  
</div>
[[+idx:add:lt=`[[+total]]`:and:mod=`[[+pageSlider]]`:isequal=`0`:then=`[[+pageSliderContent]]`]]
