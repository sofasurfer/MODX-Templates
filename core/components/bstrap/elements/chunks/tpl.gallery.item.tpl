<li class="[[+cls]]">
	    <a class="thumbnail" title="[[+name]]" href="[[+url]]" rel="[[+rel]]" [[+data-target:notempty=`data-target="[[+data-target]]"`]] [[+data-content:notempty=`data-content="[[+data-content]]"`]]  data-gallery>
	        [[+thumbnail:notempty=`<img src="[[+thumbnail]]" alt="[[+name]]" />`]]
	        [[+tv.pageimage:notempty=`<img src="[[+tv.pageimage:phpthumbof=`w=360&h=280&zc=1`]]" alt="[[+name]]" />`]]	        
	    </a>
	    [[+caption:notempty=`<div class="[[+caption-class:default=`caption`]]">[[+caption]]</div>`]]	    
</li>
[[+idx:add:lt=`[[+total]]`:and:mod=`[[+pageSlider]]`:isequal=`0`:then=`[[+pageSliderContent]]`]]